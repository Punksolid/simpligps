<?php

namespace App\Listeners;

use App\Mail\InviteMail;
use App\User;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Queue\InteractsWithQueue;

class SendUserActivationLink
{
    use InteractsWithQueue;
    use SendsPasswordResetEmails;
    public $user;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param object $event
     */
    public function handle($event)
    {
        $request = request();
        $request->email = $event->user->email;

        $this->user = $event->user;

        $hash = $this->createTokenAndGetHash($request);

//        \Mail::send(new InviteMail($this->user, $hash));
        \Mail::to($event->user)->send(new InviteMail($event->user, $hash));

//         \Notification::send($event->user, new PasswordResetRequest())  ;
    }

    /**
     * Send a reset link to the given user.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function createTokenAndGetHash(Request $request)
    {
        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $broker = $this->broker();

        return $broker->createToken($this->user);
    }
}
