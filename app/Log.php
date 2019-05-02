<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use UsesTenantConnection;

    protected $fillable = [
        "data",
        "level",
        "loggable_type",
        "loggable_id"
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array'
    ];

    public function loggable()
    {
        return $this->morphTo();
    }
}
