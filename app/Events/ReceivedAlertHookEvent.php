<?php

namespace App\Events;

use App\Account;
use App\Notifications\WialonWebhookNotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ReceivedAlertHookEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    /**
     * @var Account
     */
    private $account;
    public $data;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Account $account, $data)
    {
        $this->account = $account;
        $this->data = $data;
//        $notification = new WialonWebhookNotification("Check unit {$data['unit']}", $data);
//
//
//        $account->notify(
//            $notification
//        );
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('App.Account.'.$this->account->uuid);
    }
}
