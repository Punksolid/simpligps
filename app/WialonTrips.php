<?php

namespace App;

use App\Exceptions\TripException;
use App\Interfaces\TripsServiceContract;
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
 * @
 */
class WialonTrips implements TripsServiceContract
{
    /**
     * @var Trip
     */
    public $trip;
    /**
     * @var string
     */
    public $resource_name;

    /**
     * @var Action
     */
    private $action;

    /**
     * @var array
     */
    /**
     * @var Collection
     */
    private $checkpoints;

    public $device;
    private $wialon_units;

    /** @var Resource */
    private $resource;

    public function __construct(Trip $trip, Device $device = null, ?Collection $checkpoints = null)
    {
        $this->trip = $trip;
        $this->tenant_uuid = $this->getTenantUuid();
        $this->checkpoints = $checkpoints ? $checkpoints : $this->trip->checkpoints;
        $this->device = $device ? $device : optional($this->trip->truck)->device;
    }

    public function getDevice()
    {
        return $this->device = optional($this->trip->truck)->device;
    }
    /**
     * @return string
     */
    public function getResourceName(): string
    {
        return $this->resource_name = "simpligps.trips.{$this->trip->id}.{$this->getTenantUuid()}";
    }

    /**
     * Crea las notificaciones necesarias en wialon para un trip determinado en formato
     * con nombre entering.tripID y leaving.tripID
     * Devuelve array con los ids de las notificaciones wialon creadas.
     * Punto de entrada.
     * @return array
     *
     * @throws Exception
     */
    public function createNotificationsForTrips(): array
    {
        $wialon_notifications = collect();

        $checkpoints = $this->getCheckpoints();
        foreach ($checkpoints as $checkpoint) {
            $wialon_notifications = $wialon_notifications->merge($this->createNotificationsForEnterExitForPlace($checkpoint));
        }

        return $wialon_notifications->pluck('unique_id')->toArray();
    }

    /**
     * @todo Refactor, it should accept N ids
     * @return Collection
     */
    public function getWialonUnits()
    {
        return $this->wialon_units = Unit::findMany([$this->device->wialon_id]);
    }

    /**
     * Devuelve un resource.
     *
     * @param string $name
     * @return Resource
     * @throws TripException
     */
    public function findOrCreateResource(string $name = null)
    {
        $resource_name = $name ?: $this->getResourceName();
        try {
            $resource = Resource::findByName($resource_name);
            if (!$resource) {
                return Resource::make($resource_name);
            }
        } catch (Exception $exception) {
            throw new TripException('There was a problem with Wialon resources');
        }

        return $resource;
    }

    public function getResource()
    {
        return $this->resource ?: $this->findOrCreateResource();
    }

    /**
     * Devuelve si existe un resource creado para el viaje en Gurtam Wialon
     *
     * @return bool
     */
    public function hasResource()
    {
        return (bool)Resource::findByName($this->resource_name);
    }

    /**
     * @throws \Punksolid\Wialon\WialonErrorException
     */
    public function deleteNotifications(): bool
    {
        try {
            $resource = $this->getResource();
            if ($resource) {
                $destroy = $resource->destroy();
                info($destroy);

                return $destroy;
            }
        } catch (Exception $exception){
            \Illuminate\Support\Facades\Log::warning('Couldnt delete notification', [$exception]);
        }


        return false;
    }

    /**
     * Valida que todos los elementos del viaje están correctos y se puede crear el recurso con sus notificaciones
     * en la plataforma de wialon.
     * @deprecated Maybe a special class for validation is needed
     *
     * @use $trip->validateTruckAndTrailersHaveDevices();
     * @use $trip->validatePlacesConnection();
     * @use $trip->validateDevicesConnection();
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
        $wialon_units = $this->getWialonUnits();
        $wialon_text = new Notification\WialonText([
            'X-Tenant-Id' => $this->getTenantUuid(), //indispensables
            'timeline_id' => $checkpoint->id,
            'trip_id' => $this->getTrip()->id, //estos tres pueden ser utiles para evitar queries extras
            'device_id' => $this->getDevice()->id,
            'place_id' => $checkpoint->place->id,
        ]);

        return Notification::make(
            $this->getResource(),
            $wialon_units,
            $control_type,
            $name,
            $this->getAction(),
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
            url(config('app.url')."api/v1/{$this->getTenantUuid()}/alert/trips/".$this->getTrip()->id)
        );
    }
    public function getTrip(): Trip
    {
        return $this->trip;
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
        $trip = $this->getTrip();
        $wialon_notifications->push(
            $this->createNotification(
                $control_type,
                "{$trip->id}.entering.{$checkpoint->place->id}",
                $checkpoint
            ) // Notificacion de entradas
        );

        $control_type->setType(1); // salida
        $wialon_notifications->push(
            $this->createNotification(
                $control_type,
                "{$trip->id}.leaving.{$checkpoint->place->id}",
                $checkpoint
            ) // Notificacion de salidas
        );

        return $wialon_notifications;
    }

    public function getCheckpoints()
    {
        return $this->checkpoints = $this->trip->checkpoints;
    }

    private function getTenantUuid()
    {
        return config('database.connections.tenant.database');
    }
}
