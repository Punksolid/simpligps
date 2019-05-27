<?php

namespace App\Notifications;

use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Http\Resources\DeviceResource;

/**
 * @property mixed notifiable
 */
class WialonWebhookNotification extends Notification
{
    use Queueable;
    public $contextual_data;
    public $device;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message = null, $contextual_data = [], $device = null)
    {
        $this->message = $message ?? "Attend! Wialon Notification!";
        $this->contextual_data = $contextual_data;
        
        $this->device = new DeviceResource( $device);
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
     * {
            unit: "PTS003",
            timestamp: "2019-03-19 18:45:26",
            location: "Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
            last_location: "Calle Río Del Carmen 1058, Industrial Bravo, Culiacán, Sinaloa 80120, Mexico",
            locator_link: "http://sh-loc.com/qGKb",
            smallest_geofence_inside: "%ZONE_MIN%",
            all_geofences_inside: "%ZONES_ALL%",
            UNIT_GROUP: "%UNIT_GROUP%",
            SPEED: "1 km/h",
            POS_TIME: "2019-03-19 18:45:14",
            MSG_TIME: "2019-03-19 18:45:14",
            DRIVER: "%DRIVER%",
            DRIVER_PHONE: "%DRIVER_PHONE%",
            TRAILER: "%TRAILER%",
            SENSOR: "Bateria: 20.00 %",
            ENGINE_HOURS: "0:00:00",
            MILEAGE: "0.00 km",
            LAT: "N 24° 47.5090'",
            LON: "W 107° 24.2675'",
            LATD: "24.791816",
            LOND: "-107.404458",
            GOOGLE_LINK: "http://maps.google.com/?q=24.791816,-107.404458",
            CUSTOM_FIELD: "%CUSTOM_FIELD(*)%",
            UNIT_ID: "17471332",
            MSG_TIME_INT: "1553010314",
            NOTIFICATION: "Borrar boton SOS",
            X-Tenant-Id: "1d0b53ca894a48b2a4ef94c46e4cdcfb"
            }
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $arr = array_merge(
            ['message' => $this->message],
            $this->contextual_data,
            ["device" => $this->device]
        );
        
        // $arr['device'] = optional($this->device)->toArray();
        return $arr;
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        $broadcast_message = new BroadcastMessage(array_merge(['message' => $this->message], $this->contextual_data));

        return $broadcast_message;
    }
}
