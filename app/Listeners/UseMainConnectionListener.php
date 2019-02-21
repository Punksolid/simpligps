<?php

namespace App\Listeners;

//use App\Events\ConfigurationLoaded;
use Hyn\Tenancy\Events\Database\ConfigurationLoaded;
use Hyn\Tenancy\Events\Database\ConfigurationLoading;
use Hyn\Tenancy\Events\Websites\Created;
use Hyn\Tenancy\Events\Websites\Creating;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UseMainConnectionListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ConfigurationLoaded  $event
     * @return void
     */
    public function handle(ConfigurationLoaded $event)
    {
//        dd($event->configuration);

        $event->configuration["username"] = config("database.connections.system.username");
        $event->configuration["password"] = config("database.connections.system.password");
    }
}
