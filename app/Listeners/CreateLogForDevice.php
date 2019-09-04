<?php

namespace App\Listeners;

use App\Events\ReceiveTripUpdate;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class CreateLogForDevice implements ShouldQueue
{
    use InteractsWithQueue;

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
        activity()
            ->performedOn($event->trip->truck->device)
            ->withProperties($event->context)
            ->withProperty('level', 'info')
            ->log('Update On Trip');
    }
}
