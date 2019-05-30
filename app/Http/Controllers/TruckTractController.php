<?php

namespace App\Http\Controllers;

use App\Http\Requests\TruckTractRequest;
use App\Http\Resources\TruckTractResource;
use App\TruckTract;
use Illuminate\Http\Request;
use Tests\Feature\TruckTractTest;
use App\Interfaces\Search;

class TruckTractController extends Controller implements Search
{
    /**
     * Display a listing of the TruckTract.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trucks = TruckTract::paginate();

        return TruckTractResource::collection($trucks);
    }

    /**
     * Store a newly created TruckTract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TruckTractRequest $request)
    {
        $truck = TruckTract::make($request->all());
        $truck->carrier_id = $request->carrier_id;
        $truck->device_id = $request->device_id;

        $truck->save();

        return TruckTractResource::make($truck);
    }

    /**
     * Display the specified TruckTract.
     *
     * @param  \App\TruckTract  $truckTract
     * @return \Illuminate\Http\Response
     */
    public function show($truckTract)
    {
        $truckTract = TruckTract::with([
            'device',
            'carrier',
            'currentOperator',
            'operators'
            // 'operators' => function ($query_operators) {
            //     return $query_operators->whereHas('trips', function ($query_trips) {
            //         return $query_trips->onlyOngoing();
            //     });
            // }
        ])->findOrFail($truckTract);
        // dd($truckTract->toArray());
        return TruckTractResource::make($truckTract);
    }

    /**
     * Update the specified TruckTract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TruckTract  $truckTract
     * @return \Illuminate\Http\Response
     */
    public function update(TruckTractRequest $request, $truckTract)
    {
        $truckTract = TruckTract::findOrFail($truckTract);
        $truckTract->carrier_id = $request->carrier_id;
        $truckTract->device_id = $request->device_id;
        $truckTract->update($request->all());

        $truckTract->save();

        return TruckTractResource::make($truckTract);
    }

    /**
     * Remove the specified TruckTract from storage.
     *
     * @param  \App\TruckTract  $truckTract
     * @return \Illuminate\Http\Response
     */
    public function destroy($truckTract)
    {
        $truckTract = TruckTract::findOrFail($truckTract);

        if ($truckTract->delete()) {
            return response([
                'message' => 'Deleted Succesfully'
            ]);
        }

        return response('error', 422);
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $trucks_query = TruckTract::query();

        if ($request->filled('name')) {
            $trucks_query->where('name', 'LIKE', "%{$request->name}%");
        }
        if ($request->filled('plate')) {
            $trucks_query->where('plate', 'LIKE', "%{$request->plate}%");
        }

        return TruckTractResource::collection($trucks_query->get());
    }
}
