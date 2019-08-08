<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Punksolid\Wialon\Geofence;

class Place extends Model
{
    use UsesTenantConnection;
    use SoftDeletes;

    protected $table = 'places';

    protected $fillable = [
        'name',
        'person_in_charge',
        'address',
        'phone',
        'geofence_ref',
        'high_risk',
    ];

    protected $cast = [
        'high_risk' => 'bool',
    ];

    //Relationships

    /**
     * Devuelve todos los viajes con sus checkpoints en los pivots, un lugar puede estar en muchos viajes, a su vez
     * puede estar presente varias veces en un solo viaje, como por ejemplo cuando es origen y destino.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function trips()
    {
        return $this->belongsToMany(
            Trip::class,
            'places_trips',
            'place_id',
            'trip_id'
        )
            ->using(Timeline::class)
            ->withPivot([
                'id',
                'order',
                'at_time',
                'exiting',
                'type',
                'real_at_time',
                'real_exiting',
            ]);
    }

    public function checkpoints()
    {
        return $this->hasMany(Timeline::class);
    }

    //endregion
    //region Actions
    public function verifyConnection(): bool
    {
        if (is_null($this->geofence_ref)) {
            return false;
        }

        [$resource, $id] = explode('_', $this->geofence_ref);
        return (bool) Geofence::findById($id, $resource);
    }

    //endregion
}
