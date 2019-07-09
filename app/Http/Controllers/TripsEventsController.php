<?php

namespace App\Http\Controllers;

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
        $logs = $trip->logs()->orderByDesc('created_at')->paginate(500);

        return LogResource::collection($logs);
    }

    public function store(Trip $trip, Request $request)
    {
        $data = $request->validate([
            'message' => 'required|min:5'
        ]);
        $log = $trip->info($data['message']);
        return LogResource::make($log);
    }
}
