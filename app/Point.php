<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Point extends Model
{

    protected $fillable = [
        "lat",
        "lon",
        "point" //TODO CALCULAR DINAMICAMENTE
    ];

    /**
     * Muchos puntos pertenecen a un dispositivo
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->belongsTo(Device::class);
    }
}
