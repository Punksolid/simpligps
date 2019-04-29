<?php

namespace App\Providers;

use App\Events\AccountCreatedEvent;
use App\Events\NotificationTriggerCreated;
use App\Events\NotificationTriggerDeleted;
use App\Events\UserCreated;
use App\Listeners\CreateExternalNotification;
use App\Listeners\DeleteExternalNotification;
use App\Listeners\SendAccountSetPasswordEmail;
use App\Listeners\SendUserActivationLink;
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
        ],
//        AccountCreatedEvent::class => [
//            SendAccountSetPasswordEmail::class
//        ],
        UserCreated::class => [
            SendUserActivationLink::class
        ],
        NotificationTriggerCreated::class => [
            CreateExternalNotification::class
        ],
        NotificationTriggerDeleted::class => [
            DeleteExternalNotification::class
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
