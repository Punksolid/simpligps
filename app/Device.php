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
        "line",
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
}
