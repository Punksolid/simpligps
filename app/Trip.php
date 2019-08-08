<?php

namespace App;

use App\Exceptions\MalformedTrip;
use App\Traits\ModelLogger;
use Carbon\Carbon;
use Exception;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Punksolid\Wialon\GeofenceControlType;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Unit;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\HasTags;

class Trip extends Model implements LoggerInterface
{
    use HasTags;
    use UsesTenantConnection;
    use ModelLogger;
    use LoggerTrait;
    use LogsActivity;

    private const DEBUG = 100;
    /**
     * Interesting events.
     * Examples: User logs in, SQL logs.
     */
    private const INFO = 200;
    private const NOTICE = 250;
    /**
     * Exceptional occurrences that are not errors.
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    private const WARNING = 300;

    // Detailed debug information
    private const ERROR = 400;
    /**
     * Critical conditions.
     * Example: Application component unavailable, unexpected exception.
     */
    private const CRITICAL = 500;

    // Uncommon events
    /**
     * Action must be taken immediately.
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    private const ALERT = 550;
    private const EMERGENCY = 600;

    //Runtime Errors
    protected static $logAttributes = [
        'rp',
        'invoice',
        'mon_type',
        //operationals
        'client_id',
        'carrier_id',
        'truck_tract_id',
        'georoute_ref',
        'operator_id',
    ];
    protected static $submitEmptyLogs = false;
    protected static $logOnlyDirty = true;

    // Urgent alert.
    protected $fillable = [
        'rp',
        'invoice',
        'mon_type',
        //operationals
        'client_id',
        'carrier_id',
        'truck_tract_id',
        'georoute_ref',
        'operator_id',
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
        'real_arrival',
    ];

    public function getDescriptionForEvent(string $eventName): string
    {
//        return "The trip was $eventName";
        return "The trip :subject.rp was $eventName";
//        return 'The subject name is :subject.rp, the causer name is :causer.name and Laravel is :properties.attributes';
    }

    //region Relationships

    /**
     * Devuelve modelo del Origin.
     * @return BelongsTo
     */
    public function getOrigin()
    {
        return $this->places()->wherePivot('type', '=', 'origin')->first();
    }

    /**
     * Relacion muchos a muchos, puntos intermedios.
     */
    public function places()
    {
        return $this->belongsToMany(
            Place::class,
            'places_trips',
            'trip_id',
            'place_id'
        )
            ->using(Timeline::class)
            ->withPivot(
                [
                    'id',
                    'order',
                    'at_time',
                    'exiting',
                    'type',
                    'real_at_time',
                    'real_exiting',
                ]
            );
    }

    public function origin()
    {
        return $this->places()->wherePivot('type', '=', 'origin');
    }

    public function getOriginAttribute()
    {
        return $this->places()->wherePivot('type', '=', 'origin')->first();
    }

    public function getDestinationAttribute()
    {
        return $this->places()->wherePivot('type', '=', 'destination')->first();
    }

    public function setOrigin(Place $place, $at_time, $exiting)
    {
        return $this->places()->sync(
            [
                $place->id => [
                    'type' => 'origin',
                    'at_time' => $at_time,
                    'exiting' => $exiting,
                    'order' => 0,
                ],
            ]
        );
    }

    public function destination()
    {
        return $this->places()->wherePivot('type', '=', 'destination');
    }

    /**
     * @param Place $place
     * @param $at_time
     * @param $exiting
     * @param Carbon|null $real_at_time
     * @param Carbon|null $real_exiting
     * @return array
     */
    public function setDestination(
        Place $place,
        $at_time,
        $exiting,
        Carbon $real_at_time = null,
        Carbon $real_exiting = null
    ) {
        $last = count($this->places) + 1;

        return $this->places()->wherePivot(
            'type',
            '=',
            'destination'
        )->attach(
            $place->id,
            [
                'type' => 'destination',
                'at_time' => $at_time,
                'exiting' => $exiting,
                'real_at_time' => $real_at_time,
                'real_exiting' => $real_exiting,
                'order' => $last,
            ]
        );
    }

    /**
     * Traces son todos los registros que va dejando el plan de viaje, antes Bitacora.
     * @return HasMany
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

    public static function getTagClassName(): string
    {
        return MariadbTag::class;
    }

    /**
     * Alias de Places con pivot intermediate.
     * @return BelongsToMany
     */
    public function intermediates()
    {
        return $this->places()->wherePivot('type', '=', 'intermediate');
    }

    /**
     * Un viaje tiene un operador asignado al viaje.
     * @return BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * Trip tiene muchos logs.
     * @return MorphMany
     */
    public function logs()
    {
        return $this->morphMany(Log::class, 'loggable');
    }

    /**
     * Un Trip tiene un cliente asignado.
     */
    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }

    public function syncIntermediate($place, $at_time, $exiting)
    {
        return $this->addIntermediate($place, $at_time, $exiting, true);
    }

    /**
     * Add Intermediate Places points.
     * @param Place $place
     */
    public function addIntermediate($place_id, $at_time, $exiting, $sync = false)
    {
        $attributes = [
            'type' => 'intermediate',
            'at_time' => $at_time,
            'exiting' => $exiting,
            'order' => 0,
        ];

        if ($sync) {
            return $this->places()->sync([$place_id => $attributes]);
        }

        return $this->places()->attach($place_id, $attributes);
    }

    //endregion

    //region actions

    public function syncTrailerBox(int $trailer_box_id)
    {
        $this->addTrailerBox($trailer_box_id, true);
    }

    public function addTrailerBox(int $trailer_box_id, $sync = false)
    {
        if ($sync) {
            return $this->trailers()->sync(
                $trailer_box_id,
                [
                    'order' => 0,
                ]
            );
        }

        $this->trailers()->attach(
            $trailer_box_id,
            [
                'order' => 0,
            ]
        );
    }

    /**
     * Un viaje puede tener varias Cajas (TrailerBoxes), el campo order en pivot representa el orden de las cajas.
     * @return BelongsToMany
     */
    public function trailers()
    {
        return $this->belongsToMany(
            'App\TrailerBox',
            'trailer_boxes_trips',
            'trip_id',
            'trailer_box_id'
        )->withPivot(
            [
                'order',
            ]
        );
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
        // 2684 FAILS
        $device_id = $this->getDevices()->first()->id;
//        $device_id = $this->truck->device->id;
        $text = $this->getWialonParamsText($tenant_uuid, $device_id);

        $wialon_notifications = $this->createWialonNotifications($control_type, $wialon_units, $action, $text);

        /**
         * @todo se necesita el resource id para buscar las notificaciones en el futuro.
         * resource_id debe estar dentro de los datos
         * de la notificacion
         * es un defecto de la api de wialon, se necesita reformar la librería para que lo haga automaticamente
         */
        $resource = $this->findOrCreateWialonResource("trm.trips.{$this->id}.{$this->getTenantUuid()}");

        $wialon_notifications = $wialon_notifications->map(
            function ($wnotify) use ($resource) {
                return "{$resource->id}_$wnotify->id";
            }
        );

        return $wialon_notifications->toArray();
    }

    public function getTenantUuid()
    {
        return config('database.connections.tenant.database');
    }

    /**
     * Devuelve los ids de wialon_id.
     * @return Collection
     */
    public function getExternalWialonUnitsIds(): Collection
    {
        $devices = collect();
        $devices->push(
            $this->truck()->first()->device()->pluck('wialon_id')->first()
        );
        // logica si se quieren añadir más dispositivos va aquí
//        $devices  = $this->getDevices()->pluck('wialon_id');

        return $devices;
    }

    //endregion
    //region Getters

    /**
     * Un viaje puede tener un tracto.
     * @return BelongsTo
     */
    public function truck()
    {
        return $this->belongsTo(TruckTract::class, 'truck_tract_id');
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

    /**
     * Devuelve todos los Ids de Geofences de wialon en formato resourceId_localId.
     * @return array
     */
    public function getAllPlacesGeofences(): array
    {
        return $this->getAllPlaces()->pluck('geofence_ref')->toArray();
    }

    //endregion
    //    Override Tag class para aceptar mariadb

    public function getAllPlaces(): Collection
    {
        return $this->places()->get();
    }

    //region Scopes

    /**
     * @param Repository $tenant_uuid
     * @return Notification\Action
     */
    private function getAction($tenant_uuid): Notification\Action
    {
        $action = new Notification\Action(
            'push_messages', [
                'url' => url(config('app.url')."api/v1/$tenant_uuid/alert/trips/".$this->id),
            ]
        );

        return $action;
    }

    //endregion

    /**
     * @return mixed
     */
    public function getDevices(): Collection
    {
        $trailers = $this->trailers()
            ->whereHas('device')
            ->with('device')->get();

        $devices = $trailers->pluck('device');

        return $devices->push($this->truck->device);

//        $device_id = $this->truck->device->id;
////        // @TODO Agregar los ids de los devices de las cajas (trailerboxes) del viaje
//        return $device_id;
    }

    /**
     * El texto del formulario que devolverá wialon.
     * @param Repository $tenant_uuid
     * @param $device
     * @return string
     */
    public function getWialonParamsText($tenant_uuid, $device, $place_id = null, $timeline_id = null): string
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
        X-Tenant-Id='.$tenant_uuid.'&
        trip_id='.$this->id.'&
        device_id='.$device;
        if ($place_id) {
            $text .= "&place_id=$place_id";
        }
        if ($timeline_id) {
            $text .= "&timeline_id=$timeline_id";
        }

        $text = '"'.$text.'"';

        $text = str_replace(["\r", "\n", ' '], '', $text);

        return $text;
    }

    /**
     * @param GeofenceControlType $control_type
     * @param resource|null $resource
     * @param Collection $wialon_units
     * @param Notification\Action $action
     * @param string $text
     * @return Collection
     * @throws Exception
     */
    private function createWialonNotifications(
        GeofenceControlType $control_type,
        Collection $wialon_units,
        Notification\Action $action,
        string $text
    ) {
        $wialon_notifications = collect();
        $places = $this->places;

        foreach ($places as $place) {
            $control_type = new GeofenceControlType();

            $control_type->addGeozoneId($place->geofence_ref);

            $control_type->setType(0); // modificar control_type entrada
            $text = $this->getWialonParamsText(
                $this->getTenantUuid(),
                $this->getDevices()->first()->id,
                $place->id,
                $place->pivot->id
            );
            $wialon_notifications->push(
                $this->createWialonNotification(
                    $wialon_units,
                    $control_type,
                    "{$this->id}.entering.{$place->id}",
                    $action,
                    $text
                ) // Notificacion de entradas
            );

            $control_type->setType(1); // salida
            $wialon_notifications->push(
                $this->createWialonNotification(
                    $wialon_units,
                    $control_type,
                    "{$this->id}.leaving.{$place->id}",
                    $action,
                    $text
                ) // Notificacion de salidas
            );
        }

        return $wialon_notifications;
    }

    /**
     * @param resource|null $resource
     * @param Collection $wialon_units
     * @param GeofenceControlType $control_type
     * @param Notification\Action $action
     * @param string $text
     * @return Notification|null
     * @throws Exception
     */
    public function createWialonNotification(
        Collection $wialon_units,
        GeofenceControlType $control_type,
        $name,
        Notification\Action $action,
        string $text
    ) {
        $resource = $this->findOrCreateWialonResource("trm.trips.{$this->id}.{$this->getTenantUuid()}");

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
     * @param Repository $tenant_uuid
     * @return resource|null
     */
    public function findOrCreateWialonResource(string $name)
    {
        $resource = Resource::findByName($name);
        if (!$resource) {
            $resource = Resource::make($name);
        }

        return $resource;
    }

    public function updateTimeline($action, $timeline_id, $timestamp = null)
    {
        $timestamp = $timestamp ?: now()->toDateTimeString();

        $action = $this->getFieldToUpdate($action);

        $attributes = [
            $action => $timestamp,
        ];

        $timeline = Timeline::find($timeline_id);
        $timeline->update($attributes);

//        $this->places()->updateExistingPivot($place_id, $attributes);

        return $attributes;
    }

    /**
     * Las notificaciones pueden avisar que entraron "entering" o que salieron "exiting" segun las acciones se deben
     * actualizar los campos en la base datos.
     * @param $action
     * @return string
     */
    public function getFieldToUpdate($action): string
    {
        if ('entering' === $action) {
            return 'real_at_time';
        }

        return 'real_exiting';
    }

    public function scopeOnlyOngoing($query)
    {
        return $query->select(
            [
                'trips.*',
                'origin.id as origin_id',
                'origin.type as type',
                'origin.order as order',
                'origin.at_time as origin_at_time',
                'origin.exiting as origin_exiting',

                'destination.id as destination_id',
                'destination.type as destination type',
                'destination.order as destination order',
                'destination.at_time as destination_at_time',
                'destination.exiting as destination_exiting',
            ]
        )
            ->join(
                'places_trips as origin',
                function ($join) {
                    $join->on('trips.id', '=', 'origin.trip_id')
                        ->where('origin.type', '=', 'origin')
                        ->where('origin.at_time', '<', now()->toDateTimeString());
                }
            )
            ->join(
                'places_trips as destination',
                function ($join) {
                    $join->on('trips.id', '=', 'destination.trip_id')
                        ->where('destination.type', '=', 'destination')
                        ->where('destination.exiting', '>', now()->toDateTimeString());
                }
            );
    }

    public function deleteWialonNotificationsForTrips()
    {
//        $resource = $this->findOrCreateWialonResource("trm.trips.{$this->id}.{$this->getTenantUuid()}");
        $name = $this->wialon_resource_name;
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
     * @throws Exception
     */
    public function validateWialonReferrals(): void
    {
        $this->validateTruckAndTrailersHaveDevices();
        $this->validatePlacesConnection();
        $this->validateDevicesConnection();
    }

    public function validateTruckAndTrailersHaveDevices(): void
    {
        $bag = new MessageBag();
        $truck = $this->truck()->whereDoesntHave('device')->first();

        if ($truck) {
            $bag->add('truck', "Truck Tract with name $truck->name doesn't have a device");
        }

        $trailers = $this->trailers()->whereDoesntHave('device')->get();
        if ($trailers) {
            foreach ($trailers as $trailer) {
                $bag->add(
                    'trailer',
                    "Trailer Box with internal number $trailer->internal_number doesn't have a device"
                );
            }
        }

        if ($bag->isNotEmpty()) {
            throw ValidationException::withMessages($bag->getMessages());
        }
    }

    private function validatePlacesConnection(): void
    {
        //Validar que todos los lugares tienen geocercas conectados
        $places = $this->places;
        if ($places->count() <= 1) {
            throw new Exception('Trip needs at least origin and destination.');
        }
        $bag = new MessageBag();
        foreach ($places as $place) {
            if (!$place->verifyConnection()) {
                $bag->add('place', "The place $place->name can't connect to wialon.");
//                throw new WialonConnectionErrorException("place","The place $place->name can't connect to wialon.");
            }
        }
        if ($bag->isNotEmpty()) {
            throw ValidationException::withMessages($bag->getMessages());
        }
    }

    public function validateDevicesConnection(): void
    {
        $devices = $this->getDevices();
        $bag = new MessageBag();

        foreach ($devices as $device) {
            if (!$device->verifyConnection()) {
                $bag->add('device', "The device $device->name can't connect to wialon.");
            }
        }

        if ($bag->isNotEmpty()) {
            throw ValidationException::withMessages($bag->getMessages());
        }
    }

    public function getWialonResourceNameAttribute(): string
    {
        return "trm.trips.{$this->id}.{$this->getTenantUuid()}";
    }

    /**
     * @return mixed
     * @throws MalformedTrip
     */
    public function canCloseTrip(): bool
    {
        try {
            return (bool)$this->getDestination()->pivot->real_exiting;
        } catch (Exception $exception) {
            throw new MalformedTrip("Trip can't retrieve the real exiting field.");
        }
    }

    public function getDestination()
    {
        return $this->places()->wherePivot('type', '=', 'destination')->first();
    }

    /**
     * WTF! @deprecated.
     */
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
}
