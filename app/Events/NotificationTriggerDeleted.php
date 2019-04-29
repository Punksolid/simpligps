<?php

namespace App\Events;

use App\NotificationTrigger;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationTriggerDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var NotificationTrigger
     */
    public $notification_trigger;

    /**
     * Create a new event instance.
     *
     * @return void
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
