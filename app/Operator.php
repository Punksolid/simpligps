<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    use UsesTenantConnection;

    protected $fillable = [
        "name",
        "phone",
        "active"
    ];

    /**
     * Un operador pertenece a un carrier
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class,"carrier_id");
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

}
