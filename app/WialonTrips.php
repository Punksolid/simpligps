<?php

namespace App;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Notification\Action;
use Punksolid\Wialon\Notification\GeofenceControlType;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Unit;

/**
 * Class WialonTrips
 * Manejador de la conexión de las notificaciones de wialon para actualizar y dar seguimiento a un viaje.
 * Se obtienen los lugares
 * Por cada checkpoint se crean DOS notificaciones, una de entrada y una de salida, a cada notificacion se le añaden metadatos
 * del device_id, timeline_id y tenant_id.
 */
class WialonTrips
{
    /**
     * @var Trip
     */
    private $trip;
    /**
     * @var string
     */
    public $resource_name;

    /**
     * @var Action
     */
    private $action;
    /**
     * @var Repository
     */
    private $tenant_uuid;
    /**
     * @var array
     */
    /**
     * @var Collection
     */
    private $checkpoints;

    public $device;
    private $wialon_units;
    private $resource;

    public function __construct(Trip $trip, Device $device = null, ?Collection $checkpoints = null)
    {
        $this->trip = $trip;
        $this->resource_name = "trm.trips.{$this->trip->id}.{$this->trip->getTenantUuid()}";
        $this->tenant_uuid = $this->trip->getTenantUuid();
        $this->action = $this->getAction();

        $this->checkpoints = $checkpoints ? $checkpoints : $this->trip->checkpoints;
        $this->device = $device ? $device : optional($this->trip->truck)->device;
    }

    /**
     * Crea las notificaciones necesarias en wialon para un trip determinado en formato
     * con nombre entering.tripID y leaving.tripID
     * Devuelve array con los ids de las notificaciones wialon creadas.
     * Punto de entrada.
     */
    public function createNotificationsForTrips(): array
    {
        $wialon_notifications = collect();
        $this->wialon_units = Unit::findMany([$this->device->wialon_id]);
        $this->resource = $this->findOrCreateResource($this->resource_name);

        foreach ($this->checkpoints as $checkpoint) {
            $wialon_notifications = $wialon_notifications->merge($this->createNotificationsForEnterExitForPlace($checkpoint));
        }

        return $wialon_notifications->pluck('unique_id')->toArray();
    }

    /**
     * Devuelve un resource.
     *
     * @param Repository $tenant_uuid
     *
     * @return resource|null
     */
    public function findOrCreateResource(string $name): Resource
    {
        $resource = Resource::findByName($name);
        if (!$resource) {
            $resource = Resource::make($name);
        }

        return $resource;
    }

    public function deleteNotifications()
    {
        $name = $this->resource_name;
        $resource = Resource::findByName($name);
        if ($resource) {
            $destroy = $resource->destroy();
            info($destroy);

            return $destroy;
        }

        return false;
    }

    /**
     * Valida que todos los elementos del viaje están correctos y se puede crear el recurso con sus notificaciones
     * en la plataforma de wialon.
     *
     * @throws Exception
     */
    public function validateReferrals(): void
    {
        $this->trip->validateTruckAndTrailersHaveDevices();
        $this->trip->validatePlacesConnection();
        $this->trip->validateDevicesConnection();
    }

    /**
     * Crea una notificacion en wialon.
     *
     * @param GeofenceControlType $control_type
     * @param $name
     * @param $checkpoint
     *
     * @return Notification|null
     *
     * @throws Exception
     */
    public function createNotification(
        GeofenceControlType $control_type,
        $name,
        Timeline $checkpoint
    ) {
        $wialon_units = $this->wialon_units;
        $wialon_text = new Notification\WialonText([
            'X-Tenant-Id' => $this->tenant_uuid, //indispensables
            'timeline_id' => $checkpoint->id,
            'trip_id' => $this->trip->id, //estos tres pueden ser utiles para evitar queries extras
            'device_id' => $this->device->id,
            'place_id' => $checkpoint->place->id,
        ]);

        return Notification::make(
            $this->resource,
            $wialon_units,
            $control_type,
            $name,
            $this->action,
            $wialon_text,
            ['fl' => 0]
        );
    }

    /**
     * Devuelve objeto Action para crear Notification.
     *
     * @return Notification\Action
     */
    public function getAction(): Notification\Action
    {
        return new Notification\Action(
            'push_messages',
            url(config('app.url')."api/v1/$this->tenant_uuid/alert/trips/".$this->trip->id)
        );
    }

    /**
     * Crea las dos notificaciones necesarias para avisar que entró y salió de un checkpoint.
     * Para que reporten entradas y salidas en wialon son necesarias dos notificaciones, una para entrada y otra salida
     * Cada notificacion lleva solo 1 geocerca.
     *
     * @param Timeline   $checkpoint
     * @param Collection $wialon_notifications
     *
     * @return Collection
     *
     * @throws Exception
     */
    private function createNotificationsForEnterExitForPlace(Timeline $checkpoint)
    {
        $wialon_notifications = collect();
        $control_type = new GeofenceControlType();

        $control_type->addGeozoneId($checkpoint->place->geofence_ref);

        $control_type->setType(0); // modificar control_type entrada

        $wialon_notifications->push(
            $this->createNotification(
                $control_type,
                "{$this->trip->id}.entering.{$checkpoint->place->id}",
                $checkpoint
            ) // Notificacion de entradas
        );

        $control_type->setType(1); // salida
        $wialon_notifications->push(
            $this->createNotification(
                $control_type,
                "{$this->trip->id}.leaving.{$checkpoint->place->id}",
                $checkpoint
            ) // Notificacion de salidas
        );

        return $wialon_notifications;
    }
}
