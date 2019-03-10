<?php

namespace App\Providers;

use App\Listeners\UseMainConnectionListener;
use Hyn\Tenancy\Events\Database\ConfigurationLoaded;
use Hyn\Tenancy\Events\Database\ConfigurationLoading;
use Hyn\Tenancy\Events\Websites\Created;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Event' => [
            'App\Listeners\EventListener',
        ],
        ConfigurationLoaded::class => [
            UseMainConnectionListener::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
