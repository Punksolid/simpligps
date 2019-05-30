<?php

namespace App;

use Hyn\Tenancy\Traits\UsesTenantConnection;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    /**
     * Detailed debug information.
     */
    private const DEBUG = 100;

    /**
     * Interesting events.
     *
     * Examples: User logs in, SQL logs.
     */
    private const INFO = 200;

    /**
     * Uncommon events.
     */
    private const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors.
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    private const WARNING = 300;

    /**
     * Runtime errors.
     */
    private const ERROR = 400;

    /**
     * Critical conditions.
     *
     * Example: Application component unavailable, unexpected exception.
     */
    private const CRITICAL = 500;

    /**
     * Action must be taken immediately.
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    private const ALERT = 550;

    /**
     * Urgent alert.
     */
    private const EMERGENCY = 600;

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
