<?php

namespace App\Traits;

use App\Client;
use App\Carrier;
use App\Log;
use App\Operator;
use App\Place;
use App\Timeline;
use App\Trace;
use App\TruckTract;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait TripRelationships
{
    /**
     * Devuelve modelo del Origin.
     *
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
        return $this->places()->wherePivot('type', '=', 'origin')->take(1);
    }
    public function originCheckpoint()
    {
        return $this->hasOne(Timeline::class)
            ->with('place')
            ->where('type','origin')
            ->withDefault([
                'id' => null,
                'place' => (object)[
                    'name' => null,
                    'person_in_charge' => null,
                    'address' => null,
                    'phone' => null,
                    'high_risk' => null,
                    'geofence_ref' => null
                ],
                'at_time' => null,
                'exiting' => null,
                'real_at_time' => null,
                'real_exiting' => null
            ]);
    }
    public function destinationCheckpoint()
    {
        return $this->hasOne(Timeline::class)
            ->with('place')
            ->where('type','destination')
            ->withDefault([
                'id' => null,
                'place' => (object)[
                    'name' => null,
                    'person_in_charge' => null,
                    'address' => null,
                    'phone' => null,
                    'high_risk' => null,
                    'geofence_ref' => null
                ],
                'at_time' => null,
                'exiting' => null,
                'real_at_time' => null,
                'real_exiting' => null
            ]);
    }

    public function destination()
    {
        return $this->places()->wherePivot('type', '=', 'destination')->take(1);
    }

    /**
     * Traces son todos los registros que va dejando el plan de viaje, antes Bitacora.
     *
     * @return HasMany
     */
    public function traces()
    {
        return $this->hasMany(Trace::class, 'trip_id');
    }

    /**
     * Un viaje tiene un operador asignado al viaje.
     *
     * @return BelongsTo
     */
    public function operator()
    {
        return $this->belongsTo(Operator::class);
    }

    /**
     * Un viaje puede tener varias Cajas (TrailerBoxes), el campo order en pivot representa el orden de las cajas.
     *
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

    
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
    

    /**
     * Un viaje puede tener un tracto.
     *
     * @return BelongsTo
     */
    public function truck()
    {
        return $this->belongsTo(TruckTract::class, 'truck_tract_id');
    }

    /**
     * Alias de Places con pivot intermediate.
     *
     * @return BelongsToMany
     */
    public function intermediates()
    {
        return $this->places()->wherePivot('type', '=', 'intermediate');
    }

    /**
     * Trip tiene muchos logs.
     *
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

    /**
     * Un trip tiene muchos checkpoints, basicamente es un alias para obtener los datos pivot de places_trips directamente.
     *
     * @return mixed
     */
    public function checkpoints()
    {
        return $this->hasMany(Timeline::class);
    }
}
