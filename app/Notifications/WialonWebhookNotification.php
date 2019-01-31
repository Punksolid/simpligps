<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class WialonWebhookNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message = null)
    {
        $this->message = $message ?? "Attend! Wialon Notification!";
        $this->link = "";
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {

        return [
            'database',
            'broadcast'
        ];

    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "message" => $this->message,
            "link" => $this->link
        ];
    }
//
////    public function toBroadcast($notifiable)
////    {
////        return [
////            "message" => $this->message
////        ];
////    }
//
//    /**
//     * Get the broadcastable representation of the notification.
//     *
//     * @param  mixed  $notifiable
//     * @return BroadcastMessage
//     */
//    public function toBroadcast($notifiable)
//    {
//        return new BroadcastMessage([
//            'message' => $this->message,
//        ]);
//    }
}
