<?php

namespace App\Http\Controllers;

use App\Http\Requests\PlaceRequest;
use App\Http\Resources\PlaceResource;
use App\Place;
use Illuminate\Http\Request;
use App\Interfaces\Search;

/**
 * Class PlaceController.
 *
 * @resource Place
 */
class PlaceController extends Controller implements Search
{
    /**
     * Display a listing of the PLACE.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('all')) {
            return PlaceResource::collection(Place::all());
        }

        $places = Place::paginate();

        return PlaceResource::collection($places);
    }

    /**
     * Store a newly created PLACE in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(PlaceRequest $request)
    {
        $place = Place::create($request->all());

        return PlaceResource::make($place);
    }

    /**
     * Display the specified PLACE.
     *
     * @param \App\Place $place
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        return PlaceResource::make($place);
    }

    /**
     * Update the specified PLACE in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Place               $place
     *
     * @return \Illuminate\Http\Response
     */
    public function update(PlaceRequest $request, $place)
    {
        $place = Place::findOrFail($place);

        if ($place->update($request->all())) {
            return PlaceResource::make($place);
        }

        return response('Aconteció un error actualizando el lugar.');
    }

    /**
     * Remove the specified PLACE from storage.
     *
     * @param \App\Place $place
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($place)
    {
        $place = Place::findOrFail($place);

        if ($place->delete()) {
            return PlaceResource::make($place)->additional([
                'message' => 'Place Deleted.',
            ]);
        }

        return response('Aconteció un error');
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $places = Place::query()
            ->where('name', 'LIKE', "%{$request->name}%")
            ->paginate(50);

        return PlaceResource::collection($places);
    }
}
