<?php

namespace App\Listeners;

use App\Account;
use App\Events\ReceiveTripUpdate;
use App\Notifications\WialonWebhookNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotificationOnTripUpdate implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ReceiveTripUpdate  $event
     * @return void
     */
    public function handle(ReceiveTripUpdate $event)
    {
        $account = Account::whereUuid($event->context['X-Tenant-Id'])->firstOrFail();
        $account->notify(new WialonWebhookNotification(
            "Check TRIP {$event->trip->rp}",
            $event->context
        ));
    }
}
