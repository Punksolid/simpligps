<?php

namespace App\Http\Controllers;

use App\Http\Resources\TraceResource;
use App\Trace;
use App\Trip;
use Illuminate\Http\Request;

class TraceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Trip $trip)
    {

        return TraceResource::collection($trip->traces);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Trip $trip)
    {
        $trace = $trip->traces()->create([
            "content" => $request->all()
            ]);

        return TraceResource::make($trace);

    }



}
