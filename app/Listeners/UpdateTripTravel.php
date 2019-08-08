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
     * @param ReceiveTripUpdate $event
     * @return void
     */
    public function handle(ReceiveTripUpdate $event)
    {
        [$trip_id, $action, $place_id] = explode('.', $event->context['NOTIFICATION']);

        $timeline_id = $event->context['timeline_id'];
//        dd(isset($event->context['timestamp']) ? $event->context['timestamp'] : now()->toDateTimeString());
        $timestamp = isset($event->context['timestamp']) ? $event->context['timestamp'] : now()->toDateTimeString();
        $event->trip->updateTimeline($action, $timeline_id, $timestamp);
    }
}
