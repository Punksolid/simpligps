<?php

namespace App\Listeners;

use Hyn\Tenancy\Events\Database\ConfigurationLoaded;

class UseMainConnectionListener
{
    /**
     * Handle the event.
     *
     * @param ConfigurationLoaded $event
     */
    public function handle(ConfigurationLoaded $event)
    {
        $event->configuration['username'] = config('database.connections.system.username');
        $event->configuration['password'] = config('database.connections.system.password');
    }
}
