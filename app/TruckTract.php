<?php

namespace App;

use App\Traits\Deviceable;
use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class TruckTract extends Model
{
    use UsesTenantConnection;
    use Deviceable;

    protected $fillable = [
        'name',
        'plate',
        'model',
        'internal_number',
        'brand',
        'color',
    ];

    protected $guarded = [
//        'device_id', // dispositivo
        'carrier_id',  // linea
    ];

    //region Relationships

    /**
     * Un Tracto tiene un carrier.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Todos los operadores asignados a viajes donde Truck también ah sido asignado.
     */
    public function operators()
    {
        return $this->belongsToMany(Operator::class, 'trips', 'truck_tract_id', 'operator_id');
    }

    public function currentOperator()
    {
        return $this->operators()
            ->take(1);
    }

    //endregion
}
