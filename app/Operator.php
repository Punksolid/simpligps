<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{


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
}
