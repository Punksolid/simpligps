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
        $action = $exploded[0];
        $trip_id = $exploded[1];

        $event->trip->updateTimeline($action,$trip_id, $event->context['timestamp']);
     }


}
