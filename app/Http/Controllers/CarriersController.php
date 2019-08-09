<?php

namespace App\Http\Controllers;

use App\Carrier;
use App\Http\Requests\CarrierRequest;
use App\Http\Resources\CarrierResource;
use Illuminate\Http\Request;
use App\Interfaces\Search;

/**
 * Class CarriersController.
 *
 * @resource Carrier
 */
class CarriersController extends Controller implements Search
{
    /**
     * Display a listing of the CARRIER.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $carriers = Carrier::paginate();

        return CarrierResource::collection($carriers);
    }

    /**
     * Store a newly created CARRIER in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(CarrierRequest $request)
    {
        $carrier = Carrier::create($request->all());

        return CarrierResource::make($carrier);
    }

    /**
     * Display the specified CARRIER.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($carrier)
    {
        $carrier = Carrier::findOrFail($carrier);

        return CarrierResource::make($carrier);
    }

    /**
     * Update the specified CARRIER in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int                      $id
     *
     * @return \Illuminate\Http\Response
     */
    public function update(CarrierRequest $request, $carrier)
    {
        $carrier = Carrier::findOrFail($carrier);

        if ($carrier->update($request->all())) {
            return CarrierResource::make($carrier);
        }

        return response('Aconteció un error, no se pudo actualizar.');
    }

    /**
     * Remove the specified CARRIER from storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($carrier)
    {
        $carrier = Carrier::findOrFail($carrier);

        if ($carrier->delete()) {
            return response([
                'message' => 'Se eliminó la linea transportista.',
            ]);
        }

        return response('Aconteció un error');
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $carriers = Carrier::query();
        if ($request->filled('carrier_name')) {
            $carriers->where('carrier_name', 'LIKE', "%{$request->carrier_name}%");
        }

        return CarrierResource::collection($carriers->paginate(50));
    }
}
