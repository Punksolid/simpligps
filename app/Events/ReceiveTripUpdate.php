<?php

namespace App\Events;

use App\Trip;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ReceiveTripUpdate
{
    use Dispatchable;
    use InteractsWithSockets;
    use SerializesModels;
    /**
     * @var Trip
     */
    public $trip;
    /**
     * @var array
     */
    public $context;

    /**
     * Create a new event instance.
     */
    public function __construct(Trip $trip, $context = [])
    {
        $this->trip = $trip;
        $this->context = $context;
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
