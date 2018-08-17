<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Tags\HasTags;

class Trip extends Model
{
    use HasTags;

    protected $fillable = [
            "rp",
            "invoice",
            "client",
            "intermediary",
            "origin_id",
            "destination_id",
            "mon_type",
            "line",
            "scheduled_load",
            "scheduled_departure",
            "scheduled_arrival",
            "scheduled_unload",
            "bulk",
        //operationals
            "device_id",
        //tag
            "tag"
        ];

    protected $casts = [
        "bulk" => "array"
    ];

    protected $dates = [
        "scheduled_load",
        "scheduled_departure",
        "scheduled_arrival",
        "scheduled_unload"
    ];

    /**
     * Relacion al lugar de origen
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function origin()
    {
        return $this->belongsTo(Place::class,"origin_id");
    }

    /**
     * Relacion al lugar destino
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination()
    {
        return $this->belongsTo(Place::class, "destination_id");
    }

    /**
     * El viaje tiene un dispositivo asociado
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function devices()
    {
        return $this->belongsTo(Device::class, "device_id");
    }

    public function traces()
    {
        return $this->hasMany(Trace::class,"trip_id");
    }
};
