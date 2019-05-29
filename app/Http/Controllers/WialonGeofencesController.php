<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Punksolid\Wialon\Wialon;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Geofence;
use App\Http\Resources\GeofenceResource;

class WialonGeofencesController extends Controller
{
    public function store(Request $request)
    {
        /**
         * Recibe Resource_ID, Nombre, Latitud, Longitud y  radio.
         */
        $validated_request = $this->validate($request, [
            'name' => 'required',
            'lat' => 'required',
            'lon' => 'required',
            'radius' => 'required',
        ]);

        $uuid = Str::uuid();

        $wialon_api = new Wialon();
        // $resource = $wialon_api->createResource();
        //TODO resource puede ser creado si no es especificado o usar uno preexistente
        $resource = Resource::make('trm.gfence.'.$uuid);
        $geofence = $wialon_api->createGeofence( // deprecar en favor de Geofence::make el cual no funciona correctamente
            $resource->id,
            $validated_request['name'],
            $validated_request['lat'],
            $validated_request['lon'],
            $validated_request['radius'],
            3
        );

        return GeofenceResource::make($geofence);
    }
}
