<?php

namespace App\Traits;

use Carbon\Carbon;
use App\Log;
use phpDocumentor\Reflection\Types\Integer;

/**
 * Model logger.
 */
trait ModelLogger
{
    public function log($log_level, $message = '', array $context = [], array $extra = [])
    {
        $data = [
            'message' => $message,
            'channel' => 'devices',
            'level' => $this->levelNumber($log_level),
            'level_name' => $log_level,
            'context' => $context,
            'datetime' => Carbon::now(),
            'extra' => $extra,
        ];
        $log = new Log($data);

        return $this->logs()->save($log);
    }

    public function levelNumber($level_name): integer
    {
        $level = [
            'emergency' => 600, //  Urgent alert.
            'alert' => 550,  //  Action must be taken immediately.
            'critical' => 500, // Critical conditions.
            'error' => 400, //  Runtime errors.
            'warning' => 300, //Exceptional occurrences that are not errors.
            'notice' => 250, //  Uncommon events.
            'info' => 200, //Interesting events.
            'debug' => 100, // Detailed debug information.
        ];

        return $level[$level_name];
    }
}
