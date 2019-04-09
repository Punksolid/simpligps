<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InviteMail extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var User
     */
    public $user;
    /**
     * @var string
     */
    public $url;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user, $token = 'aaaa')
    {
        $this->user = $user;
        $this->token = $token;
        $this->url =  config("app.frontend_url")."/#/login?continue_registration=".$this->token."&email=".$this->user->email;
//        http://localhost:9528/#/login?continue_registration=7ed86e62fb633caf9c628edded27f88821b7d02e2fe2c8c27f979865009ff6c4
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->markdown('mail.invitation');
    }
}
