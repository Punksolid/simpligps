<?php

namespace App\Http\Controllers;

use App\Http\Resources\WialonNotificationResource;
use App\Http\Resources\WialonResourceResource;
use App\Http\Resources\WialonUnitResource;
use App\Setting;
use Illuminate\Http\Request;
use Punksolid\Wialon\ControlType;
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
    public function __construct()
    {
        $token = (new \App\Setting)->getWialonToken();
        config(['services.wialon.token' => $token]);
    }

    public function getResources()
    {

        $resources = \Cache::remember('resources', 500, function () {
            return $resources = Resource::all();

        });
        return WialonResourceResource::collection($resources);
    }

    public function getNotifications()
    {
        $notifications = Notification::all();

        return WialonNotificationResource::collection($notifications);
    }


    public function getUnits()
    {
        $units = Unit::all();

        return WialonUnitResource::collection($units);
    }

    /**
     * Create Wialon Notification
     * @param Request $request
     * @return WialonNotificationResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws \Punksolid\Wialon\WialonErrorException
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:40',
            'units.*' => 'required|integer',
            'control_type' => 'required',
            'resource' => 'required'
        ]);

        $resource = Resource::find($validatedData['resource']);
        $control_type = new ControlType($validatedData['control_type']);
        $units = Unit::findMany($validatedData['units']);
        $action = new Notification\Action('push_messages', [
            "url" => url('api/v1/webhook/alert')
        ]);


        $notification = Notification::make($resource, $units, $control_type, $request->name, $action);

        return WialonNotificationResource::make($notification);
    }
}
