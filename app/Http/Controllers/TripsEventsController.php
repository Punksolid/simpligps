<?php

namespace App\Http\Controllers;

use App\Http\Resources\LogResource;
use App\Trip;

/*
*
*Se encarga de los Logs de los Viajes
*
*/
class TripsEventsController extends Controller
{
    public function index(Trip $trip)
    {
        $notifications = $trip->logs;

        return LogResource::collection($notifications);
    }
}
