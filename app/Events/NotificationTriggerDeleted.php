<?php

namespace App\Events;

use App\NotificationTrigger;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NotificationTriggerDeleted
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    /**
     * @var NotificationTrigger
     */
    public $notification_trigger;

    /**
     * Create a new event instance.
     */
    public function __construct(NotificationTrigger $notification_trigger)
    {
        $this->notification_trigger = $notification_trigger;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
