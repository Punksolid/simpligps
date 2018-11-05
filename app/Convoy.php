<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Convoy extends Model
{
    protected $fillable = [
       "internal_id"
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

}
