<?php

namespace App\Notifications;

use App\NotificationType;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DynamicNotification extends Notification
{
    use Queueable;

    public $alias;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(NotificationType $notification_type)
    {
       $this->alias = $notification_type->alias;
       $this->active = $notification_type->active;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if ($this->active){
            return ['mail',"database"];
        }
        return null;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line("Notificación dinamica ($this->alias)")
                    ->action('Atender', url('/'))
                    ->line('Notificación dinamica');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            "message" => "Notificación dinamica ($this->alias)"
        ];
    }
}
