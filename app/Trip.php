<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
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
     * Devuelve array con los ids de las notificaciones wialon creadas.
     */
    public function createWialonNotification(): array
    {
        $tenant_uuid = config('database.connections.tenant.database');

        $resource = Resource::findByName("trm.trips.{$this->id}.{$tenant_uuid}");
        if (!$resource) {
            $resource = Resource::make("trm.trips.{$this->id}.{$tenant_uuid}");
        }

        $unit_id = $this->getExternalUnitsIds();
        $unit_id = $unit_id->map(function ($element) {
            return (int) $element;
        });

        $wialon_units = Unit::findMany($unit_id->toArray());
//        $wialon_units = collect(Unit::find($unit_id->first()->toArray()));
        /**
         * Y en las notificaciones agregas las geocercas que quieres tomar en cuenta
         * para que te reporten entradas y salidas 2 notificaciones
         * una con parametro de entrada y con todas las geocercas del viaje. y otra con parametro de salida con todas las geocercas del viaje.
         */
        $control_type = new GeofenceControlType();

        $control_type->setType(0); // entrada
        $all_geofences = $this->getAllPlacesGeofences();
        foreach ($all_geofences as $geofence) {
            $control_type->addGeozoneId($geofence);
        }

        $action = new Notification\Action('push_messages', [
            'url' => url(config('app.url')."api/v1/$tenant_uuid/alert/trips/".$this->id),
        ]);
        $device = $this->truck->device->id;
        $text = '"unit=%UNIT%&
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
        device_id='.$device.'
        "';

        $text = str_replace(["\r", "\n", ' '], '', $text);
        $wialon_notifications = collect();
        $wialon_notifications->push(Notification::make($resource, $wialon_units, $control_type, "entering.{$this->id}", $action, [
            'txt' => $text,
        ])); // Notificacion de entradas

        $control_type->setType(1); // salida
        $wialon_notifications->push(Notification::make($resource, $wialon_units, $control_type, "leaving.{$this->id}", $action, [
            'txt' => $text,
        ])); // Notificacion de salidas

        $wialon_notifications = $wialon_notifications->map(function ($wnotify) use ($resource) {
            return "{$resource->id}_$wnotify->id";
        });

        return $wialon_notifications->toArray();
    }

    public function updateTimeline($action, $place_id, $timestamp = null)
    {
        $timestamp = $timestamp ?: now()->toDateTimeString();

        $place_with_pivot = $this->intermediates()->find($place_id);


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
        $geofences_ids = [
            $this->origin()->pluck('geofence_ref')->first(),
            $this->destination()->pluck('geofence_ref')->first(),
        ];

        $intermediates = $this->intermediates()->pluck('geofence_ref');

        return array_merge($geofences_ids, $intermediates->toArray());
    }

    /**
     * Devuelve los ids de wialon_id.
     *
     * @return Collection
     */
    public function getExternalUnitsIds(): Collection
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
}
