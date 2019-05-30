<?php

namespace App\Listeners;

use App\Events\NotificationTriggerDeleted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;

class DeleteExternalNotification implements ShouldQueue
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
     * @param NotificationTriggerDeleted $event
     */
    public function handle(NotificationTriggerDeleted $event)
    {
        if ($event->notification_trigger->wialon_id) {
            $wialon_notification = Notification::findByUniqueId($event->notification_trigger->wialon_id);

            $wialon_notification->resource = new Resource(['id' => explode('_', $event->notification_trigger->wialon_id)[0]]);

            if (!$wialon_notification->destroy()) {
                $event->notification_trigger->restore();
            }
        }
    }
}
