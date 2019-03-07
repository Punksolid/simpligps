<?php

namespace App\Http\Controllers;

use App\Carrier;
use App\Http\Middleware\IdentifyTenantConnection;
use App\Http\Requests\CarrierRequest;
use App\Http\Resources\CarrierResource;
use Illuminate\Http\Request;

/**
 * Class CarriersController
 * @package App\Http\Controllers
 * @resource Carrier
 */
class CarriersController extends Controller
{

    /**
     * Display a listing of the CARRIER.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carriers = Carrier::paginate();
        return CarrierResource::collection($carriers);
    }

    /**
     * Store a newly created CARRIER in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Carrier $carrier)
    {
        return CarrierResource::make($carrier);
    }

    /**
     * Update the specified CARRIER in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CarrierRequest $request, Carrier $carrier)
    {
        if ($carrier->update($request->all())){
            return CarrierResource::make($carrier);
        }

        return response("Aconteció un error, no se pudo actualizar.");
    }

    /**
     * Remove the specified CARRIER from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Carrier $carrier)
    {
        if ($carrier->delete()){
            return response([
                "message" => "Se eliminó la linea transportista."
            ]);
        }

        return response("Aconteció un error");
    }
}
