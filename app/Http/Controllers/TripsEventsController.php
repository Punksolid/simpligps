<?php

namespace App\Http\Controllers;

use App\Http\Resources\InternalNotificationResource;
use App\Http\Resources\LogResource;
use App\Trip;
use Illuminate\Http\Request;
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
