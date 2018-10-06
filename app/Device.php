<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        "plate",
        "internal_number",
        "color",
        "brand",
        "gps",
        "model",
        "wialon_id",
        "carrier_id",
        "group_id",

        "bulk"
    ];

    protected $casts = [
        "bulk" => "array"
    ];

    /**
     * Un dispositivo puede estar registrado en muchos viajes
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    /**
     * Relación, un dispositivo pertenece a un carrier, antes linea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function carrier()
    {
        return $this->belongsTo(Carrier::class,"carrier_id");
    }


    /**
     * Un dispositivo tiene muchos puntos de localización
     *
     */
    public function points()
    {
        /** @var TYPE_NAME $this */
        return $this->hasMany(Point::class);
    }
}
