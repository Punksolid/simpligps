<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Trip;
use Carbon\Carbon;
use Illuminate\Http\Request;

/**
 * Class TripsController.
 *
 * @resource Trips
 */
class TripsController extends Controller
{
    /**
     * Lista todos los viajes sin filtros.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Trip::query()->orderByDesc('created_at');
        if ($request->has('filter')) {
            $query = $query->withAnyTags($request->filter);
        }

        $trips = $query->paginate();

        return TripResource::collection($trips);
    }

    /**
     * filtra viajes por etiquetas.
     *
     * @param array $tags
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function filteredWithTags(Request $request)
    {
//        $trips_filtered = Trip::withAllTags($tags)->get(); //todo cambiar a Mariadb10.2

        $trips_filtered = Trip::where('tag', $request->tag)->get();

        return response($trips_filtered);
    }

    public function assignTag(Trip $trip, Request $request)
    {
//        $trip->attachTag($request->tag); //TODO update mariadb to 10.2 actualmente tiene 10.1
        $trip->tag = $request->tag;
        $trip->save();

        return response($trip);
    }

    /**
     * Creación de nuevo viaje.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return TripResource|\Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {
        $trip = Trip::make($request->except([
            'scheduled_load',
            'scheduled_departure',
            'scheduled_arrival',
            'scheduled_unload',
            ]));
        $trip->scheduled_load = new Carbon($request->scheduled_load); // format 2019-05-25T14:35:00.000Z
        $trip->scheduled_departure = new Carbon($request->scheduled_departure);
        $trip->scheduled_arrival = new Carbon($request->scheduled_arrival);
        $trip->scheduled_unload = new Carbon($request->scheduled_unload);

        $trip->origin_id = $request->origin_id;
        $trip->destination_id = $request->destination_id;
        $trip->carrier_id = $request->carrier_id;
        $trip->truck_tract_id = $request->truck_tract_id;
        $trip->operator_id = $request->operator_id;
        $trip->client_id = $request->client_id;
        $trip->save();
        foreach ($request->intermediates as $intermediate_id) {
            $trip->addIntermediate($intermediate_id);
        }
        foreach ($request->trailers_ids as $trailers_id) {
            $trip->addTrailerBox($trailers_id);
        }

        try {
            $trip->createWialonNotification();
        } catch (\Exception $exception) {
            \Log::error('Something happened when creating external notifications', $trip->toArray());
        }

        return TripResource::make($trip);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Trip $trip
     *
     * @return \Illuminate\Http\Response
     */
    public function show($trip_id)
    {
        $trip = Trip::with([
            'origin',
            'destination',
            'intermediates',
            'device',
            'trailers',
            'tags',
            'truck',
            'operator',
            'client',
        ])->findOrFail($trip_id);

        return TripResource::make($trip);
    }

    /**
     * Editar viaje.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Trip                $trip
     *
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, $trip)
    {
        $trip = Trip::findOrFail($trip);

        $trip->origin_id = $request->origin_id;
        $trip->destination_id = $request->destination_id;
        $trip->carrier_id = $request->carrier_id;
        $trip->truck_tract_id = $request->truck_tract_id;

        foreach ($request->intermediates as $intermediate_id) {
            $trip->addIntermediate($intermediate_id);
        }
        foreach ($request->trailers_ids as $trailers_id) {
            $trip->addTrailerBox($trailers_id);
        }

        $trip->update($request->all());

        return TripResource::make($trip->load('trailers'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Trip $trip
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        if ($trip->delete()) {
            return response([
                'message' => 'eliminado',
            ]);
        }

        return response([
            'message' => 'falló al eliminar el viaje',
        ]); //todo cambiar por thwrow exception
    }
}
