<?php

namespace App\Listeners;

use App\Events\AccountCreatedEvent;
use App\Notifications\PasswordResetRequest;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAccountSetPasswordEmail implements ShouldQueue
{
    use InteractsWithQueue, SendsPasswordResetEmails;

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
     * @param  AccountCreatedEvent  $event
     * @return void
     */
    public function handle(AccountCreatedEvent $event)
    {
        $request = request();
        $request->email = $event->user->email;
        $this->sendResetLinkEmail($request);

//         \Notification::send($event->user, new PasswordResetRequest())  ;
    }
}
