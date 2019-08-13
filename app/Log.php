<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use UsesTenantConnection;

    public $channel;

    protected $fillable = [
        'context',
        'message',
        'level',
        'level_name',
        'datetime',
        'channel',
        'loggable_type',
        'loggable_id',
        'extra',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'context' => 'array',
        'extra' => 'array',
    ];

    public function loggable()
    {
        return $this->morphTo();
    }
}
