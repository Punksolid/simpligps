<?php

namespace App\Listeners;

use App\Events\ReceiveTripUpdate;

class UpdateTripTravel
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
    }

    /**
     * Handle the event.
     *
     * @param ReceiveTripUpdate $event
     */
    public function handle(ReceiveTripUpdate $event)
    {
        [$trip_id, $action, $place_id] = explode('.', $event->context['NOTIFICATION']);

        $timeline_id = $event->context['timeline_id'];

        $timestamp = isset($event->context['timestamp']) ? $event->context['timestamp'] : now()->toDateTimeString();
        $event->trip->updateTimeline($action, $timeline_id, $timestamp);
    }
}
