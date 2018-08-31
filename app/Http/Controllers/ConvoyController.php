<?php

namespace App\Http\Controllers;

use App\Convoy;
use App\Trip;
use Illuminate\Http\Request;

/**
 * Class ConvoyController
 * @package App\Http\Controllers
 * @resource Convoy
 */
class ConvoyController extends Controller
{
    /**
     * Display a listing of the convoy.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convoys = Convoy::with("trips")->get();
        return response($convoys);
    }



    /**
     * Store a newly created convoy in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $convoy = Convoy::create();
        $trips = Trip::findMany($request->trips_ids);

        $convoy->trips()->saveMany($trips);

        return response($convoy->fresh("trips"));
    }

    /**
     * Display the specified convoy.
     *
     * @param  \App\Convoy  $convoy
     * @return \Illuminate\Http\Response
     */
    public function show(Convoy $convoy)
    {
        $convoy = $convoy->load("trips");
        return response($convoy);
    }



    /**
     * Remove the specified convoy from storage.
     *
     * @param  \App\Convoy  $convoy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convoy $convoy)
    {
        //
    }
}
