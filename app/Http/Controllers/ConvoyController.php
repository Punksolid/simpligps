<?php

namespace App\Http\Controllers;

use App\Convoy;
use App\Trip;
use Illuminate\Http\Request;

class ConvoyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $convoys = Convoy::with("trips")->get();
        return response($convoys);
    }



    /**
     * Store a newly created resource in storage.
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
     * Display the specified resource.
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Convoy  $convoy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Convoy $convoy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Convoy  $convoy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Convoy $convoy)
    {
        //
    }
}
