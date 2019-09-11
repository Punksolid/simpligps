<?php

namespace App;

use App\Http\Requests\TripRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CreateTrip
{
    /**
     * @param TripRequest $request
     *
     * @return mixed
     */
    public static function createNewTrip(Request $request)
    {

        $trip = new Trip(
            $request->except(
                [
                    'scheduled_load',
                    'scheduled_departure',
                    'scheduled_arrival',
                    'scheduled_unload',
                ]
            )
        );
        $trip->save();
        $trip->setOrigin(
            Place::findOrFail($request->origin_id),
            new Carbon($request->scheduled_load),
            new Carbon($request->scheduled_departure)
        );

        $trip->syncIntermediates($request->intermediates);

        $trip->setDestination(
            Place::findOrFail($request->destination_id),
            new Carbon($request->scheduled_arrival),
            new Carbon($request->scheduled_unload)
        );

        if ($request->has('trailers_ids')) {
            $trip->syncTrailerBox($request->trailers_ids);
        }

        return $trip;
    }
}
