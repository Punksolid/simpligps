<?php

namespace App\Listeners;

use App\Events\NotificationTriggerCreated;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Log;

class CreateExternalNotification implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param NotificationTriggerCreated $event
     */
    public function handle(NotificationTriggerCreated $event)
    {
        Log::info('ListenerTouched');
        $event->notification_trigger->createExternalNotification($event->control_type, $event->params);
    }

    public function createExternalNotification($event)
    {
        $event->notification_trigger->createExternalNotification($event->control_type, $event->params);
    }
}
