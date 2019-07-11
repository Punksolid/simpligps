<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TruckTract extends Model
{
    use UsesTenantConnection;

    protected $fillable = [
        'name',
        'plate',
        'model',
        'internal_number',
        'brand',
        'gps',
        'color',
    ];

    protected $guarded = [
        'device_id', // dispositivo
        'carrier_id',  // linea
    ];

    //region Relationships

    /**
     * Un tracto tiene un dispositivo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

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
        /*
         *  'App\Post',
            'App\User',
            'country_id', // Foreign key on users table...
            'user_id', // Foreign key on posts table...
            'id', // Local key on countries table...
            'id' // Local key on users table...
         */

        return $this->belongsToMany(Operator::class, 'trips', 'truck_tract_id', 'operator_id');
    }

    public function currentOperator()
    {
        return $this->operators()
            ->wherePivot('scheduled_load', '<', Carbon::now())
            ->wherePivot('scheduled_unload', '>', Carbon::now())
            ->take(1);
    }

    //endregion

    public function assignDevice(Device $device)
    {
        return $this->update(['device_id', $device->id]);
    }

    public function getLocation():array
    {

        if ($this->device){
            return $this->device->getLocation();
        }

        return [
            'lat' => null,
            'lon' => null
        ];
    }
}
