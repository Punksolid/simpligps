<?php

namespace App\Http\Controllers;

use App\Http\Requests\TruckTractRequest;
use App\Http\Resources\TruckTractResource;
use App\TruckTract;
use Illuminate\Http\Request;
use Tests\Feature\TruckTractTest;

class TruckTractController extends Controller
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
        $truckTract = TruckTract::findOrFail($truckTract);

        return TruckTractResource::make($truckTract);
    }

    /**
     * Update the specified TruckTract in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TruckTract  $truckTract
     * @return \Illuminate\Http\Response
     */
    public function update(TruckTractRequest $request,  $truckTract)
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
    public function destroy( $truckTract)
    {
        $truckTract = TruckTract::findOrFail($truckTract);

        if ($truckTract->delete()){
            return response([
                'message' => 'Deleted Succesfully'
            ]);
        }

        return response('error', 422);
    }
}