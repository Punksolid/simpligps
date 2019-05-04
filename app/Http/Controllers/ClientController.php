<?php

namespace App\Http\Controllers;

use App\Client;
use App\Http\Requests\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ContactResource;
use Illuminate\Http\Request;
use App\Interfaces\SearchInterface;

class ClientController extends Controller implements SearchInterface
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::paginate();

        return ClientResource::collection($clients);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClientRequest $request)
    {
        $client = Client::create($request->all());

        return ClientResource::make($client);
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
    public function update(ClientRequest $request, $client_id)
    {
        $client = Client::findOrFail($client_id);
        $client->update($request->all());

        return ClientResource::make($client);
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

        return ClientResource::make($client);
    }

    public function search(\Illuminate\Http\Request $request)
    {
        $clients = Client::query();
        
        if($request->filled('company_name')){
            $clients->where('company_name', 'LIKE', "%{$request->company_name}%");
        }
        
        if($request->filled('person_name')){
            $clients->where('person_name', 'LIKE', "%{$request->person_name}%");
        }
        
        $clients = $clients->get();
        
        return ClientResource::collection($clients);
    }
}
