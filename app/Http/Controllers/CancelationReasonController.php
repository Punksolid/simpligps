<?php

namespace App\Http\Controllers;

use App\CancelationReason;
use Illuminate\Http\Request;

class CancelationReasonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(
            CancelationReason::paginate() 
        );
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|min:3|max:50"
        ]);

        $cancelation_reason = CancelationReason::create($data);

        return response([
            "data" => [
                "name" => $cancelation_reason->name
            ]
        ]);
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\CancelationReason  $cancelationReason
     * @return \Illuminate\Http\Response
     */
    public function edit(CancelationReason $cancelationReason)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\CancelationReason  $cancelationReason
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CancelationReason $cancelationReason)
    {
        $data = $request->validate([
            "name" => "required|min:3"
        ]);
        $cancelationReason->update($data);

        return response([
            "data" => $cancelationReason
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CancelationReason  $cancelationReason
     * @return \Illuminate\Http\Response
     */
    public function destroy(CancelationReason $cancelationReason)
    {
        $cancelationReason->delete();
        return response([
            "data" => $cancelationReason
        ]);
    }
}
