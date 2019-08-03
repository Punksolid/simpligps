<?php

namespace App\Http\Controllers;

use App\Device;
use App\Http\Requests\TrailerBoxRequest;
use App\Http\Resources\TrailerBoxResource;
use App\TrailerBox;
use Illuminate\Http\Request;

class TrailerBoxController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trailers = TrailerBox::paginate();

        return TrailerBoxResource::collection($trailers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrailerBoxRequest $request)
    {
        $trailer = new TrailerBox($request->all());
        $trailer->carrier_id = $request->carrier_id;
        $trailer->assignDevice(Device::find($request->device_id));
        $trailer->save();
        return TrailerBoxResource::make($trailer->fresh('carrier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TrailerBox  $trailerBox
     * @return \Illuminate\Http\Response
     */
    public function update(TrailerBoxRequest $request, $trailerBox)
    {
        $trailer = TrailerBox::findOrFail($trailerBox);

        $trailer = $trailer->fill($request->all());
        $trailer->carrier_id = $request->carrier_id;
        $trailer->assignDevice(Device::find($request->device_id));
        $trailer->save();
        return TrailerBoxResource::make($trailer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TrailerBox  $trailerBox
     * @return \Illuminate\Http\Response
     */
    public function destroy($trailerBox)
    {
        $trailer = TrailerBox::findOrFail($trailerBox);

        $trailer->delete();

        return TrailerBoxResource::make($trailer);
    }
}
