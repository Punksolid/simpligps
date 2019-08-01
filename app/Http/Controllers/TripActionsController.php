<?php

namespace App\Http\Controllers;

use App\Trip;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Punksolid\Wialon\Resource;

class TripActionsController extends Controller
{
    /**
     * Dar salida a un viaje, verifica que se cumplan las condiciones de los elementos que pudieran estar asociados a
     * wialon
     * @param Trip $trip
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function giveExit(Trip $trip, Request $request)
    {

        $this->validate($request, [
            'enable_automatic_updates' => 'required|bool'
        ]);
        if ($request->enable_automatic_updates){
            if ($trip->validateWialonReferrals()){
                $array_wialon_notifications_ids = $trip->createWialonNotificationsForTrips();
                if (count($array_wialon_notifications_ids)>=1) {
                    return response()->json([
                        'data' => 'Exit with automatic updates were created succesfully.'
                    ]);
                } else {
                    return response()->json([
                        'message' => 'No tracking were created'
                    ]);
                }

            } else {
                return \response()->json(['message' => 'Validation did not pass']);
            }
        }

        return \response()->json(['data' => "No data were validated"]);
    }

    public function destroy(Trip $trip)
    {
        if ($trip->deleteWialonNotificationsForTrips()){
            return \response()->json([
                'message' => 'Automatic Updates Deactivated.'
            ]);
        }

        return \response()->json([
            'message' => 'An Error Ocurred or Did Not Have Automatic Updates Activated.'
        ]);
    }

    public function closeTrip(Trip $trip)
    {
        if (!$trip->canCloseTrip()){
            throw  ValidationException::withMessages([
                'real_exiting' => "The Real Schedule Unload is not yet defined, in order to close the trip you need to specify it."
            ]);
        }

        if ($trip->canCloseTrip()) {
            try {
                $trip->deleteWialonNotificationsForTrips();
            } catch (\Exception $exception) {
                info("Closing Trips That Wialon Notifications Thrown an exception: $exception->getMessage()");
            }
            return \response()->json([
                "message" => "Trip $trip->id Closed"
            ]);
        }

    }

}
