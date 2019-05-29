<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Log;

/**
 * Model logger.
 */
trait ModelLogger
{
    public function log($log_level, $message = '', array $context = [], array $extra = [])
    {
        $level = [
            'emergency' => self::EMERGENCY,
            'alert' => self::ALERT,
            'critical' => self::CRITICAL,
            'error' => self::ERROR,
            'warning' => self::WARNING,
            'notice' => self::NOTICE,
            'info' => self::INFO,
            'debug' => self::DEBUG,
        ];

        $data = [
            'message' => $message,
            'channel' => 'devices',
            'level' => $level[$log_level],
            'level_name' => $log_level,
            'context' => $context,
            'datetime' => Carbon::now(),
            'extra' => $extra,
        ];
        $log = new Log($data);

        return $this->logs()->save($log);
    }
}
