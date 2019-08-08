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
        $logs = $trip->activities()->orderByDesc('created_at')->paginate(100);

        return LogResource::collection($logs);
    }

    public function store(Trip $trip, Request $request)
    {
        $data = $request->validate([
            'message' => 'required|min:5'
        ]);
        activity()
            ->performedOn($trip)
            ->withProperty('level', 'info')
            ->log($data['message']);

        return response()->json('ok');
    }
}
