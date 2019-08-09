<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class AccountCreatedEvent
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    public $user;
    public $account;

    /**
     * Create a new event instance.
     */
    public function __construct($user, $account)
    {
        $this->user = $user;
        $this->account = $account;
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
