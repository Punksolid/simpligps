<?php

namespace App\Events;

use App\NotificationTrigger;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class NotificationTriggerCreated
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    /**
     * @var NotificationTrigger
     */
    public $notification_trigger;
    public $control_type;
    public $params;

    /**
     * Create a new event instance.
     *
     * @param NotificationTrigger $notification_trigger
     * @param $control_type
     * @param $params
     */
    public function __construct(NotificationTrigger $notification_trigger, $control_type, $params)
    {
        \Log::info('NotificationTriggerNameInEvent', [$notification_trigger->toArray()]);
        $this->notification_trigger = $notification_trigger;
        $this->control_type = $control_type;
        $this->params = $params;
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
