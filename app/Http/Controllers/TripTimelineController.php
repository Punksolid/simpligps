<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheckpointResource;
use App\Http\Resources\PlaceResource;
use App\Place;
use App\Timeline;
use App\Trip;
use Illuminate\Http\Request;

class TripTimelineController extends Controller
{
    public function index(Trip $trip)
    {
        $places = $trip->places()->get();

        return response()->json($places);
    }

    public function patch( $checkpoint, Request $request)
    {
        $this->validate($request, [
            'at_time' => 'date',
            'exiting' => 'date',
            'real_at_time' => 'date',
            'real_exiting' => 'date',
            'order' => 'integer'
        ]);
        $checkpoint = Timeline::with('place')->findOrFail($checkpoint);

        if ($request->filled('at_time')){
            $checkpoint->at_time = $request->at_time;
        }
        if ($request->filled('exiting')){
            $checkpoint->exiting = $request->exiting;
        }
        if ($request->filled('real_at_time')){
            $checkpoint->real_at_time = $request->real_at_time;
        }
        if ($request->filled('real_exiting')){
            $checkpoint->real_exiting = $request->real_exiting;
        }
        if ($request->filled('order')){
            $checkpoint->order = $request->order;
        }
        $checkpoint->save();

        return CheckpointResource::make($checkpoint);


    }
}
