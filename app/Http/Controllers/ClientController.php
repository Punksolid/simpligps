<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate();

        return ContactResource::collection($clients);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $client = Client::create($request->all());

        return ContactResource::make($client);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Client  $clientModel
     * @return \Illuminate\Http\Response
     */
    public function show($client_id)
    {
        $client = Client::findOrFail($client_id);

        return response()->json($client);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $clientModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $client_id)
    {
        $client = Client::findOrFail($client_id);
        $client->update($request->all());

        return ContactResource::make($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $clientModel
     * @return \Illuminate\Http\Response
     */
    public function destroy($client_id)
    {
        $client = Client::findOrFail($client_id);

        $client->delete();

        return ContactResource::make($client);
    }
}
