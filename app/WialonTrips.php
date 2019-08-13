<?php

namespace App;

use Exception;
use Illuminate\Config\Repository;
use Illuminate\Support\Collection;
use Punksolid\Wialon\GeofenceControlType;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Notification\Action;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Unit;

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

    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
        $this->resource_name = $this->getWialonResourceNameAttribute();
        $this->tenant_uuid = $this->trip->getTenantUuid();
        $this->action = $this->getAction();
    }

    /**
     * Crea las notificaciones necesarias en wialon para un trip determinado en formato
     * con nombre entering.tripID y leaving.tripID
     * Devuelve array con los ids de las notificaciones wialon creadas.
     */
    public function createWialonNotificationsForTrips(): array
    {
        $unit_id = $this->getExternalWialonUnitsIds();
        $wialon_units = Unit::findMany($unit_id->toArray());

        $wialon_notifications = $this->createWialonNotifications($wialon_units);

        /**
         * @todo se necesita el resource id para buscar las notificaciones en el futuro.
         * resource_id debe estar dentro de los datos
         * de la notificacion
         * es un defecto de la api de wialon, se necesita reformar la librería para que lo haga automaticamente
         */
        $resource = $this->findOrCreateWialonResource($this->resource_name);

        return $wialon_notifications->map(
            function ($wnotify) use ($resource) {
                return "{$resource->id}_$wnotify->id";
            }
        )->toArray();
    }

    /**
     * Devuelve los ids de wialon_id.
     *
     * @return Collection
     */
    public function getExternalWialonUnitsIds(): Collection
    {
        $devices = collect();
        $devices->push(
            $this->trip->truck()->first()->device()->pluck('wialon_id')->first()
        );
        // logica si se quieren añadir más dispositivos va aquí
//        $devices  = $this->>$this->trip->getDevices()->pluck('wialon_id');

        return $devices;
    }

    /**
     * El texto del formulario que devolverá wialon.
     *
     * @param $device
     * @param null $place_id
     * @param null $timeline_id
     *
     * @return string
     */
    public function getWialonParamsText($device, $place_id = null, $timeline_id = null): string
    {
        $text = new WialonParamText([
            'X-Tenant-Id' => $this->tenant_uuid,
            'trip_id' => $this->trip->id,
            'device_id' => $device,
        ]);
        if ($place_id) {
            $text->addParameter('place_id', $place_id);
        }
        if ($timeline_id) {
            $text->addParameter('timeline_id', $timeline_id);
        }

        return '"'.$text->getText().'"';
    }

    /**
     * Devuelve un resource.
     *
     * @param Repository $tenant_uuid
     *
     * @return resource|null
     */
    public function findOrCreateWialonResource(string $name): Resource
    {
        $resource = Resource::findByName($name);
        if (!$resource) {
            $resource = Resource::make($name);
        }

        return $resource;
    }

    public function deleteWialonNotificationsForTrips()
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

    public function getWialonResourceNameAttribute(): string
    {
        return "trm.trips.{$this->trip->id}.{$this->trip->getTenantUuid()}";
    }

    /**
     * @param Collection $wialon_units
     *
     * @return Collection
     *
     * @throws Exception
     */
    private function createWialonNotifications(
        Collection $wialon_units
    ) {
        $wialon_notifications = collect();
        $places = $this->trip->places;

        foreach ($places as $place) {
            $this->createNotificationsForEnterExitForPlace($wialon_units, $place, $wialon_notifications);
        }

        return $wialon_notifications;
    }

    /**
     * Valida que todos los elementos del viaje están correctos y se puede crear el recurso con sus notificaciones
     * en la plataforma de wialon.
     *
     * @throws Exception
     */
    public function validateWialonReferrals(): void
    {
        $this->trip->validateTruckAndTrailersHaveDevices();
        $this->trip->validatePlacesConnection();
        $this->trip->validateDevicesConnection();
    }

    /**
     * Crea una notificacion en wialon.
     *
     * @param resource|null       $resource
     * @param Collection          $wialon_units
     * @param GeofenceControlType $control_type
     * @param Notification\Action $action
     * @param string              $text*
     *
     * @return Notification|null
     *
     * @throws Exception
     */
    public function createWialonNotification(
        Collection $wialon_units,
        GeofenceControlType $control_type,
        $name,
        Notification\Action $action,
        string $text
    ) {
        $resource = $this->findOrCreateWialonResource($this->resource_name);

        return Notification::make(
            $resource,
            $wialon_units,
            $control_type,
            $name,
            $action,
            [
                'txt' => $text,
            ]
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
            [
                'url' => url(config('app.url')."api/v1/$this->tenant_uuid/alert/trips/".$this->trip->id),
            ]
        );
    }

    /**
     * @return GeofenceControlType
     */
    public function getControlType(): GeofenceControlType
    {
        $control_type = new GeofenceControlType(); // Inicializar control types

        $all_geofences = $this->trip->getAllPlacesGeofences();
        foreach ($all_geofences as $geofence) {
            $control_type->addGeozoneId($geofence);
        }

        return $control_type;
    }

    /**
     * Crea las dos notificaciones necesarias para avisar que entró y salió de un checkpoint.
     * Para que reporten entradas y salidas en wialon son necesarias dos notificaciones, una para entrada y otra salida
     * Cada notificacion lleva solo 1 geocerca.
     *
     * @param Collection $wialon_units
     * @param $place
     * @param Collection $wialon_notifications
     *
     * @throws Exception
     */
    private function createNotificationsForEnterExitForPlace(Collection $wialon_units, $place, Collection $wialon_notifications): void
    {
        $control_type = new GeofenceControlType();

        $control_type->addGeozoneId($place->geofence_ref);

        $control_type->setType(0); // modificar control_type entrada
        $text = $this->getWialonParamsText(
            $this->trip->getDevices()->first()->id,
            $place->id,
            $place->pivot->id
        );

        $wialon_notifications->push(
            $this->createWialonNotification(
                $wialon_units,
                $control_type,
                "{$this->trip->id}.entering.{$place->id}",
                $this->action,
                $text
            ) // Notificacion de entradas
        );

        $control_type->setType(1); // salida
        $wialon_notifications->push(
            $this->createWialonNotification(
                $wialon_units,
                $control_type,
                "{$this->trip->id}.leaving.{$place->id}",
                $this->action,
                $text
            ) // Notificacion de salidas
        );
    }
}
