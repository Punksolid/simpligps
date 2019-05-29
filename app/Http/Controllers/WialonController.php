<?php

namespace App\Http\Controllers;

use App\Http\Resources\GeofenceResource;
use App\Http\Resources\WialonResourceResource;
use App\Http\Resources\WialonUnitResource;
use Punksolid\Wialon\Geofence;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Unit;

/**
 * Class WialonController.
 *
 * @resource Wialon
 */
class WialonController extends Controller
{
    public function getResources()
    {
        $resources = \Cache::remember('resources', 500, function () {
            return $resources = Resource::all();
        });

        return WialonResourceResource::collection($resources);
    }

    public function getUnits()
    {
        $units = Unit::all();

        return WialonUnitResource::collection($units);
    }

    public function getGeofences()
    {
        $geofences = Geofence::all();

        return GeofenceResource::collection($geofences);
    }
}
