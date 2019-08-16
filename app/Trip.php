<?php

namespace App;

use App\Exceptions\MalformedTrip;
use App\Traits\ModelLogger;
use App\Traits\TripRelationships;
use Carbon\Carbon;
use Exception;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\ValidationException;
use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Tags\HasTags;

class Trip extends Model implements LoggerInterface
{
    use HasTags;
    use UsesTenantConnection;
    use ModelLogger;
    use LoggerTrait;
    use LogsActivity;
    use TripRelationships;

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
    /**
     * @var WialonTrips
     */
    public $wialon_trips;

    public function tags(): MorphToMany
    {
        return $this
            ->morphToMany(self::getTagClassName(), 'taggable', 'taggables', null, 'tag_id')
            ->orderBy('order_column');
    }

    /**
     * Todas las conexiones automaticas pasan por aqui, cuando se quiera usar drivers nuevos  se tendr[a que crear otra
     * clase para ellas.
     *
     * @return WialonTrips
     */
    public function wialon()
    {
        return  new WialonTrips( $this);
    }

    public function getDescriptionForEvent(string $eventName): string
    {
//        return "The trip was $eventName";
        return "The trip :subject.rp was $eventName";
//        return 'The subject name is :subject.rp, the causer name is :causer.name and Laravel is :properties.attributes';
    }

    //region Relationships

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

    /**
     * @param Place $place
     * @param $at_time
     * @param $exiting
     * @param Carbon|null $real_at_time
     * @param Carbon|null $real_exiting
     *
     * @return array
     */
    public function setDestination(
        Place $place,
        $at_time,
        $exiting,
        ?Carbon $real_at_time = null,
        ?Carbon $real_exiting = null
    ) {
//        $last = count($this->places) + 1;
        $last = $this->places()->count() + 1; // Refactor if performance is needed

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

    public static function getTagClassName(): string
    {
        return MariadbTag::class;
    }

    public function syncIntermediate($place, $at_time, $exiting)
    {
        return $this->addIntermediate($place, $at_time, $exiting, true);
    }

    /**
     * Sincroniza todos los lugares intermedios.
     * Quita los que no están presentes y agrega los nuevos, los que ya están los actualiza.
     *
     * @param array $intermediates
     */
    public function syncIntermediates(array $intermediates)
    {
        $index = 1;
        foreach ($intermediates as &$intermediate) {
            $intermediate['type'] = 'intermediate';
            $intermediate['at_time'] = new Carbon($intermediate['at_time']);
            $intermediate['exiting'] = new Carbon($intermediate['exiting']);
            $intermediate['order'] = $index;

            ++$index;
        }

        return $this->intermediates()->sync($intermediates);
    }

    /**
     * Add Intermediate Places points.
     *
     * @param Place $place
     *
     * @return
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

    /**
     * Sincroniza los trailers agregados y elimina los que ya estaban.
     *
     * @param int $trailer_box_id
     *
     * @return array
     */
    public function syncTrailerBox(array $trailer_boxes_ids)
    {
        return $this->trailers()->sync($trailer_boxes_ids);
    }

    /**
     * Agrega caja de trailer al viaje.
     *
     * @param int $trailer_box_id
     */
    public function addTrailerBox(int $trailer_box_id)
    {
        $this->trailers()->attach(
            $trailer_box_id,
            [
                'order' => 0,
            ]
        );
    }

    public function getTenantUuid()
    {
        return config('database.connections.tenant.database');
    }

    //endregion
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

    //endregion
    //    Override Tag class para aceptar mariadb

    public function getAllPlaces(): Collection
    {
        return $this->places()->get();
    }

    //region Scopes

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

    public function updateTimeline($action, $timeline_id, $timestamp = null)
    {
        $timestamp = $timestamp ? $timestamp : now()->toDateTimeString();

        $action = $this->getFieldToUpdate($action);

        $attributes = [
            $action => $timestamp,
        ];

        $timeline = Timeline::find($timeline_id);
        $timeline->update($attributes);

        return $attributes;
    }

    /**
     * Las notificaciones pueden avisar que entraron "entering" o que salieron "exiting" segun las acciones se deben
     * actualizar los campos en la base datos.
     *
     * @param $action
     *
     * @return string
     */
    public function getFieldToUpdate($action): string
    {
        if ($action === 'entering') {
            return 'real_at_time';
        }

        return 'real_exiting';
    }

    public function scopeOnlyOngoing($query)
    {
        return $query->select([
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
        ])->join(
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

    public function validateTruckAndTrailersHaveDevices(): void
    {
        $bag = new MessageBag();
        $this->validateTruck($bag);

        $trailers_without_devices = $this->trailers()->whereDoesntHave('device')->get() ?: [];

        foreach ($trailers_without_devices as $trailer) {
            $bag->add(
                'trailer',
                "Trailer Box with internal number $trailer->internal_number doesn't have a device"
            );
        }

        if ($bag->isNotEmpty()) {
            throw ValidationException::withMessages($bag->getMessages());
        }
    }

    public function validatePlacesConnection(): void
    {
        //Validar que todos los lugares tienen geocercas conectados
        $places = $this->places()->get();
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

    /**
     * @return mixed
     *
     * @throws MalformedTrip
     */
    public function canCloseTrip(): bool
    {
        try {
            return (bool) $this->getDestination()->pivot->real_exiting;
        } catch (Exception $exception) {
            throw new MalformedTrip("Trip can't retrieve the real exiting field.");
        }
    }

    public function getDestination()
    {
        return $this->places()->wherePivot('type', '=', 'destination')->first();
    }

    /**
     * @param MessageBag $bag
     */
    public function validateTruck(MessageBag $bag): void
    {
        $truck = $this->truck()->whereDoesntHave('device')->first();

        if ($truck) {
            $bag->add('truck', "Truck Tract with name $truck->name doesn't have a device");
        }
    }
}
