<?php

namespace App\Http\Controllers;

use App\Http\Requests\TripRequest;
use App\Trip;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Maatwebsite\Excel\Excel;

class TripsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Creación de nuevo viaje
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TripRequest $request)
    {
        $trip = Trip::create(["bulk" => $request->all()]);
        return response()->json(
            array_merge(["id" => $trip->id],$trip->bulk));
    }

    /**
     * Subir archivo excel
     * @param Request $request
     */
    public function upload(Request $request)
    {
        $path = $request->viajes->getRealPath();
        $data = \Excel::load($path)->toObject();
        $page = $data->first();
        $page->dump();
        foreach ($page->items() as $page){
            dd($page);
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function show(Trip $trip)
    {
        //
    }

    /**
     * Editar viaje
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function update(TripRequest $request, Trip $trip)
    {
        $trip->update(["bulk" => $request->all()]);
        return response()->json(
            array_merge(["id" => $trip->id],$trip->bulk));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Trip  $trip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Trip $trip)
    {
        if ($trip->delete()){
            return response([
                "message" => "eliminado"
            ]);
        }
        return response([
            "message" => "falló al eliminar el viaje"
        ]); //todo cambiar por thwrow exception

    }
}
