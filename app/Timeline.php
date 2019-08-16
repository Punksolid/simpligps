<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Este es un MODELO ESPECIAL, es un PIVOT de Trips y Places
 * Util para toda la logica que tenga que ver con Origen, Destino e Intermedios.
 *
 * Class Timeline
 */
class Timeline extends Pivot
{
    use UsesTenantConnection;

    public const NOT_YET_THERE = 0;
    public const HERE_IT_IS = 1;
    public const ALREADY_PASSED_HERE = 2;

    protected $table = 'places_trips';

    public $incrementing = true;

    protected $fillable = [
        'place_id',
        'at_time',
        'exiting',
        'real_at_time',
        'real_exiting',
        'type',
        'order',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class);
    }
}
