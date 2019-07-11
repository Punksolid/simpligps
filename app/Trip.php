<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Punksolid\Wialon\Geofence;
use Punksolid\Wialon\GeofenceControlType;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Unit;
use Spatie\Tags\HasTags;
use Carbon\Carbon;
use App\Traits\ModelLogger;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class Trip extends Model implements LoggerInterface
{
    use HasTags, UsesTenantConnection,ModelLogger, LoggerTrait;

    // Detailed debug information
    private const DEBUG = 100;

    /**
     * Interesting events.
     *
     * Examples: User logs in, SQL logs.
     */
    private const INFO = 200;

    // Uncommon events
    private const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors.
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    private const WARNING = 300;

    //Runtime Errors
    private const ERROR = 400;

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     */
    private const CRITICAL = 500;

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    private const ALERT = 550;

    // Urgent alert.
    private const EMERGENCY = 600;

    protected $fillable = [
        'rp',
        'invoice',
        'client_id',
        'origin_id',
        'destination_id',
        'mon_type',
        'scheduled_load',
        'scheduled_departure',
        'scheduled_arrival',
        'scheduled_unload',
        'bulk',
        'georoute_ref',
    //operationals
        'device_id',
        'carrier_id',
        'truck_tract_id',
        'real_departure',
        'real_arrival',
    //tag
        'tag',
    ];

    protected $casts = [
        'bulk' => 'array',
    ];

    protected $dates = [
        'scheduled_load',
        'scheduled_departure',
        'scheduled_arrival',
        'scheduled_unload',
        'real_departure',
        'real_arrival'
    ];

    //region Relationships

    /**
     * Relacion al lugar de origen.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function origin()
    {
        return $this->belongsTo(Place::class, 'origin_id');
    }

    /**
     * Relacion al lugar destino.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination()
    {
        return $this->belongsTo(Place::class, 'destination_id');
    }

    /**
     * El viaje tiene un dispositivo asociado.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo(Device::class, 'device_id');
    }

    /**
     * Traces son todos los registros que va dejando el plan de viaje, antes Bitacora.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function traces()
    {
        return $this->hasMany(Trace::class, 'trip_id');
    }

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    /**
     * Relacion muchos a muchos, puntos intermedios.
     */
    public function places()
    {
        return $this->belongsToMany(
            Place::class,
            'places_trips',
            'place_id',
            'trip_id'
        )
            ->withPivot([
                'order',
                'at_time',
                'exiting',
                'type',
                'real_at_time',
                'real_exiting'
            ]);
    }

    /**
     * Alias de Places con pivot intermediate.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function intermediates()
    {
        return $this->places()->wherePivot('type', '=', 'intermediate');
    }

    /**
     * Un viaje puede tener varias Cajas (TrailerBoxes), el campo order en pivot representa el orden de las cajas.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function trailers()
    {
        return $this->belongsToMany(
            'App\TrailerBox',
            'trailer_boxes_trips',
            'trip_id',
            'trailer_box_id'
        )->withPivot([
            'order',
        ]);
    }

    /**
     * Un viaje puede tener un tracto.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function truck()
    {
        return $this->belongsTo(TruckTract::class, 'truck_tract_id');
    }

    /**
     * Un viaje tiene un operador asignado al viaje.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * Trip tiene muchos logs.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function logs()
    {
        return $this->morphMany(\App\Log::class, 'loggable');
    }

    /**
     * Un Trip tiene un cliente asignado.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    //endregion

    #region actions

    /**
     * Add Intermediate Places points.
     *
     * @param Place $place
     */
    public function addIntermediate($place_id, $at_time, $exiting)
    {
        return $this->places()->attach($place_id, [
            'type' => 'intermediate',
            'at_time' => $at_time,
            'exiting' => $exiting,
            'order' => 0,
        ]);
    }

    public function addTrailerBox(int $trailer_box_id)
    {
        $this->trailers()->attach($trailer_box_id, [
            'order' => 0,
        ]);
    }

    /**
     * Crea las notificaciones necesarias en wialon para un trip determinado en formato
     * con nombre entering.tripID y leaving.tripID
     * Devuelve array con los ids de las notificaciones wialon creadas.
     */
    public function createWialonNotificationsForTrips(): array
    {

        $tenant_uuid = $this->getTenantUuid();

        $unit_id = $this->getExternalWialonUnitsIds();

        $wialon_units = Unit::findMany($unit_id->toArray());
        /**
         * para que te reporten entradas y salidas en total 2 notificaciones
         * una con parametro de entrada y con todas las geocercas del viaje. y otra con parametro de salida con todas las geocercas del viaje.
         */
        $control_type = $this->getControlType();

        $action = $this->getAction($tenant_uuid);

        $device_id = $this->getDevices();
        $text = $this->getWialonParamsText($tenant_uuid, $device_id);

        $wialon_notifications = $this->createWialonNotifications($control_type, $wialon_units, $action, $text);

        /**
         * @todo se necesita el resource id para buscar las notificaciones en el futuro.
         * resource_id debe estar dentro de los datos
         * de la notificacion
         * es un defecto de la api de wialon, se necesita reformar la librería para que lo haga automaticamente
         */
        $resource = $this->findOrCreateWialonResource("trm.trips.{$this->id}.{$this->getTenantUuid()}");

        $wialon_notifications = $wialon_notifications->map(function ($wnotify) use ($resource) {
            return "{$resource->id}_$wnotify->id";
        });

        return $wialon_notifications->toArray();
    }

    public function updateTimeline($action, $place_id, $timestamp = null)
    {
        $timestamp = $timestamp ?: now()->toDateTimeString();

        $action = $action == 'entering' ? 'real_at_time':'real_exiting';
        $attributes = [
          $action => $timestamp
        ];

        $this->intermediates()->updateExistingPivot($place_id, $attributes);

        return $attributes;
    }
    #endregion
    //region Getters

    /**
     * Devuelve todos los Ids de Geofences de wialon en formato resourceId_localId.
     *
     * @return array
     */
    public function getAllPlacesGeofences(): array
    {
        return $this->getAllPlaces()->pluck('geofence_ref')->toArray();

    }

    public function getAllPlaces():Collection
    {
        $places = collect([
            $this->origin()->first(),
            $this->destination()->first(),
        ]);

        return $places->concat($this->intermediates()->get());
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
            $this->truck()->first()->device()->pluck('wialon_id')->first()
        );
        // logica si se quieren añadir más dispositivos va aquí

        return $devices;
    }

    //endregion
    //    Override Tag class para aceptar mariadb
    public static function getTagClassName(): string
    {
        return MariadbTag::class;
    }

    //region Scopes
    public function scopeOnlyOngoing($query)
    {
        $query->where('scheduled_load', '<', Carbon::now());
        $query->where('scheduled_unload', '>', Carbon::now());

        return $query;
    }

    //endregion

    /**
     * El texto del formulario que devolverá wialon
     * @param \Illuminate\Config\Repository $tenant_uuid
     * @param $device
     * @return string
     */
    public function getWialonParamsText( $tenant_uuid, $device, $place_id = null): string
    {
        $text = 'unit=%UNIT%&
        timestamp=%CURR_TIME%&
        location=%LOCATION%&
        last_location=%LAST_LOCATION%&
        locator_link=%LOCATOR_LINK(60,T)%&
        smallest_geofence_inside=%ZONE_MIN%&
        all_geofences_inside=%ZONES_ALL%&
        UNIT_GROUP=%UNIT_GROUP%&
        SPEED=%SPEED%&
        POS_TIME=%POS_TIME%&
        MSG_TIME=%MSG_TIME%&
        DRIVER=%DRIVER%&
        DRIVER_PHONE=%DRIVER_PHONE%&
        TRAILER=%TRAILER%&
        SENSOR=%SENSOR(*)%&
        ENGINE_HOURS=%ENGINE_HOURS%&
        MILEAGE=%MILEAGE%&
        LAT=%LAT%&
        LON=%LON%&
        LATD=%LATD%&
        LOND=%LOND%&
        GOOGLE_LINK=%GOOGLE_LINK%&
        CUSTOM_FIELD=%CUSTOM_FIELD(*)%&
        UNIT_ID=%UNIT_ID%&
        MSG_TIME_INT=%MSG_TIME_INT%&
        NOTIFICATION=%NOTIFICATION%&
        X-Tenant-Id=' . $tenant_uuid . '&
        trip_id=' . $this->id . '&
        device_id=' . $device;
        if ($place_id){
            $text = $text."&place_id=$place_id";
        }

        $text = '"'.$text.'"';


        $text = str_replace(["\r", "\n", ' '], '', $text);

        return $text;
    }

    /**
     * @param \Illuminate\Config\Repository $tenant_uuid
     * @return Resource|null
     */
    public function findOrCreateWialonResource(String $name)
    {
        $resource = Resource::findByName($name);
        if (!$resource) {
            $resource = Resource::make($name);
        }
        return $resource;
    }

    /**
     * @param Resource|null $resource
     * @param Collection $wialon_units
     * @param GeofenceControlType $control_type
     * @param Notification\Action $action
     * @param string $text
     * @return Notification|null
     * @throws \Exception
     */
    public function createWialonNotification( Collection $wialon_units, GeofenceControlType $control_type,$name, Notification\Action $action, string $text)
    {
        $resource = $this->findOrCreateWialonResource("trm.trips.{$this->id}.{$this->getTenantUuid()}");

        return Notification::make($resource, $wialon_units, $control_type, $name, $action, [
            'txt' => $text,
        ]);
    }

    /**
     * @param \Illuminate\Config\Repository $tenant_uuid
     * @return Notification\Action
     */
    private function getAction($tenant_uuid): Notification\Action
    {
        $action = new Notification\Action('push_messages', [
            'url' => url(config('app.url') . "api/v1/$tenant_uuid/alert/trips/" . $this->id),
        ]);
        return $action;
    }

    /**
     * @return GeofenceControlType
     */
    private function getControlType(): GeofenceControlType
    {
        $control_type = new GeofenceControlType(); // Inicializar control types

        $all_geofences = $this->getAllPlacesGeofences();
        foreach ($all_geofences as $geofence) {
            $control_type->addGeozoneId($geofence);
        }
        return $control_type;
    }

    private function nameToDefine()
    {

        $all_geofences = $this->getAllPlacesGeofences();
        foreach ($all_geofences as $geofence) {
            $control_type = new GeofenceControlType($geofence); // Inicializar control types
            $control_type->setType(0); // enter
//            $this->createWialonNotification($resource, $wialon_units, $control_type, "entering.{$this->id}", $action, $text)); // Notificacion de entradas

            $this->createWialonNotification();
//            $control_type->addGeozoneId($geofence);
        }
    }

    /**
     * @param GeofenceControlType $control_type
     * @param Resource|null $resource
     * @param Collection $wialon_units
     * @param Notification\Action $action
     * @param string $text
     * @return Collection
     * @throws \Exception
     */
    private function createWialonNotifications(GeofenceControlType $control_type, Collection $wialon_units, Notification\Action $action, string $text)
    {
        $wialon_notifications = collect();
        $places = $this->getAllPlaces();
        foreach ($places as $place){
            $control_type = new GeofenceControlType();
            $control_type->addGeozoneId($place->geofence_ref);

            $control_type->setType(0); // modificar control_type entrada
            $text = $this->getWialonParamsText($this->getTenantUuid(),$this->getDevices(),$place->id);
            $wialon_notifications->push(
                $this->createWialonNotification( $wialon_units, $control_type, "{$this->id}.entering.{$place->id}", $action, $text) // Notificacion de entradas
            );

            $control_type->setType(1); // salida
            $wialon_notifications->push(
                $this->createWialonNotification( $wialon_units, $control_type, "{$this->id}.leaving.{$place->id}", $action, $text) // Notificacion de salidas
            );
        }
        return $wialon_notifications;
    }

    /**
     * @return mixed
     *
     */
    public function getDevices()
    {
        $device_id = $this->truck->device->id;
        // @TODO Agregar los ids de los devices de las cajas (trailerboxes) del viaje
        return $device_id;
    }

    public function getTenantUuid()
    {
        return config('database.connections.tenant.database');
    }

    public function deleteWialonNotificationsForTrips()
    {
        $resource = $this->findOrCreateWialonResource("trm.trips.{$this->id}.{$this->getTenantUuid()}");

        if ($resource->destroy()){
            return true;
        }
        return false;
    }
}
