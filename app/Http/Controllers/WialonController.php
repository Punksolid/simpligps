<?php

namespace App\Http\Controllers;

use App\Http\Requests\WialonNotificationRequest;
use App\Http\Resources\GeofenceResource;
use App\Http\Resources\WialonNotificationResource;
use App\Http\Resources\WialonResourceResource;
use App\Http\Resources\WialonUnitResource;
use App\Setting;
use Cache;
use Illuminate\Http\Request;
use Punksolid\Wialon\ControlType;
use Punksolid\Wialon\Geofence;
use Punksolid\Wialon\GeofenceControlType;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\Unit;

/**
 * Class WialonController
 * @package App\Http\Controllers
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
