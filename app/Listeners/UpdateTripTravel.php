<?php

namespace App\Listeners;

use App\Events\ReceiveTripUpdate;
use App\Place;
use App\Trip;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateTripTravel
{
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
        $exploded = explode('.',$event->context['NOTIFICATION']);
        $trip_id = $exploded[0];
        $action = $exploded[1];
        $place_id = $event->context['place_id'];
        $event->trip->updateTimeline($action, $place_id, $event->context['timestamp']);
     }


}
