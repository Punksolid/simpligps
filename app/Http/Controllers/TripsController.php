<?php

namespace App\Http\Controllers;

use App\CreateTrip;
use App\Http\Requests\TripRequest;
use App\Http\Resources\TripResource;
use App\Place;
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
        $query = Trip::query()
            ->withCount('checkpoints')
            ->with([
                'client:id,company_name',
                'truck:id,name,created_at,updated_at',
                'checkpoints.place',
                'places',
                'origin',
                'destination',
                'tags'
            ])
            ->orderByDesc('created_at');
        if ($request->has('filter')) {
            $query = $query->withAnyTags($request->filter);
        }

        $trips = $query->paginate();
//        return $trips;
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
        $request->validate([
            'tags' => 'present|array',
        ]);
        $trip->syncTags($request->tags); //TODO update mariadb to 10.2 actualmente tiene 10.1
        $trip->load('tags');

        return TripResource::make($trip);
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
        $trip = CreateTrip::createNewTrip($request);

        $trip->load('client', 'intermediates', 'origin', 'destination');

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
            'trailers',
            'tags',
            'truck',
            'operator',
            'client',
            'carrier'
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
        $trip->setOrigin(Place::findOrFail($request->origin_id), new Carbon($request->scheduled_load), new Carbon($request->scheduled_departure));
        $trip->syncIntermediates($request->intermediates);
        $trip->setDestination(Place::findOrFail($request->destination_id), new Carbon($request->scheduled_arrival), new Carbon($request->scheduled_unload));
        $trip->syncTrailerBox($request->trailers_ids);

        $trip->update($request->all());

        return TripResource::make($trip->load(
            'origin',
            'destination',
            'intermediates',
            'trailers',
            'tags',
            'truck',
            'operator',
            'client',
            'carrier'
        ));
    }

    public function patch(Trip $trip, TripRequest $request)
    {
        if ($request->has('origin_id')) {
            $trip->setOrigin(Place::findOrFail($request->origin_id), new Carbon($request->scheduled_load), new Carbon($request->scheduled_departure));
        }

        if ($request->has('intermediates')) {
            $trip->syncIntermediates($request->intermediates);
        }

        if ($request->has('destination_id')) {
            $trip->setDestination(Place::findOrFail($request->destination_id), new Carbon($request->scheduled_arrival), new Carbon($request->scheduled_unload));
        }

        if ($request->has('trailers_ids')) {
            $trip->syncTrailerBox($request->trailers_ids);
        }

        $trip->update($request->all());

        return TripResource::make($trip->load('trailers', 'intermediates'));
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
        $trip->wialon()->deleteNotifications();

        if ($trip->delete()) {
            return response([
                'message' => 'eliminado',
            ]);
        }

        throw new \Exception("Couldn't delete trip");
    }
}
