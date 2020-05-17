<?php

namespace App\Http\Controllers;

use App\Account;
use App\Events\ReceiveTripUpdate;
use App\Trip;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class TripActionsController extends Controller
{
    /**
     * Dar salida a un viaje, verifica que se cumplan las condiciones de los elementos que pudieran estar asociados a
     * wialon.
     *
     * @param Trip    $trip
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function giveExit(Trip $trip, Request $request)
    {
        $this->validate($request, [
            'enable_automatic_updates' => 'required|bool',
        ]);
        $trip->validateReferrals();

        if ($request->enable_automatic_updates) {
            $array_wialon_notifications_ids = $trip->createNotificationsForTrips();
            if (count($array_wialon_notifications_ids) >= 1) {
                return response()->json([
                    'notifications_total' => count($array_wialon_notifications_ids),
                    'notifications' => $array_wialon_notifications_ids,
                    'data' => 'Exit with automatic updates were created succesfully.',
                ]);
            }
        }

        return \response()->json(['data' => 'No data were validated']);
    }

    public function destroy(Trip $trip)
    {
        if ($trip->wialon()->deleteNotifications()) {
            return \response()->json([
                'message' => 'Automatic Updates Deactivated.',
            ]);
        }

        return \response()->json([
            'message' => 'An Error Ocurred or Did Not Have Automatic Updates Activated.',
        ]);
    }

    public function closeTrip(Trip $trip)
    {
        if (!$trip->canCloseTrip()) {
            throw  ValidationException::withMessages([
                'real_exiting' => 'The Real Schedule Unload is not yet defined, in order to close the trip you need to specify it.',
            ]);
        }

        if ($trip->canCloseTrip()) {
            try {
                $trip->wialon()->deleteNotifications();
            } catch (\Exception $exception) {
                info("Closing Trips That Wialon Notifications Thrown an exception: {$exception->getMessage()}");
            }

            return \response()->json([
                'message' => "Trip $trip->id Closed",
            ]);
        }
    }

    /**
    * Aqui se reciben los webhooks de los trips, está separado de los de las notificaciones sencillas
    *
    **/
    public function exceptionUpdate(Request $request, $tenant_uuid, $trip_id)
    {
        $account = Account::whereUuid($tenant_uuid)->firstOrFail();

        $environment = app(\Hyn\Tenancy\Environment::class);
        $environment->tenant($account);
        $trip = Trip::findOrFail($trip_id);

        event(new ReceiveTripUpdate($trip, $request->all()));

        return response()->json('ok');
    }
}
