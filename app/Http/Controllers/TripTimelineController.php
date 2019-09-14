<?php

namespace App\Http\Controllers;

use App\Http\Resources\CheckpointResource;
use App\Timeline;
use App\Trip;
use Illuminate\Http\Request;
use Carbon\Carbon;

/**
 * Administra funciones de los checkpoints
 */
class TripTimelineController extends Controller
{
    /**
     * Lista todos los lugares de un viaje
     */
    public function index(Trip $trip)
    {
        $places = $trip->places()->get();

        return response()->json($places);
    }

    /**
     * Actualiza los valores del checkpoint, util para cuando se quiere cerrar un viaje de forma manual
     * 
     */
    public function patch($checkpoint, Request $request)
    {
        $this->validate($request, [
            'at_time' => 'date',
            'exiting' => 'date',
            'real_at_time' => 'date',
            'real_exiting' => 'date',
            'order' => 'integer',
        ]);
        $checkpoint = Timeline::with('place')->findOrFail($checkpoint);

        if ($request->filled('at_time')) {
            $checkpoint->at_time = new Carbon( $request->at_time);
        }
        if ($request->filled('exiting')) {
            $checkpoint->exiting = new Carbon( $request->exiting);
        }
        if ($request->filled('real_at_time')) {
            $checkpoint->real_at_time = new Carbon( $request->real_at_time);
        }
        if ($request->filled('real_exiting')) {
            $checkpoint->real_exiting = new Carbon( $request->real_exiting);
        }
        if ($request->filled('order')) {
            $checkpoint->order = $request->order;
        }
        $checkpoint->save();

        return CheckpointResource::make($checkpoint);
    }
}
