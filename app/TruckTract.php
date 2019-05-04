<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

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
        'color'
    ];

    protected $guarded = [
        'device_id',// dispositivo
        'carrier_id'  // linea
    ];

    #region Relationships

    /**
     * Un tracto tiene un dispositivo
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }

    /**
     * Un Tracto tiene un carrier
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class);
    }
    #endregion

}
