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

class WialonController extends Controller
{
    public function __construct()
    {
        $token = (new \App\Setting)->getWialonToken();
        config(['services.wialon.token' => $token]);
    }

    public function getResources()
    {
        $setting_wialon_key = optional(Setting::where('key', 'wialon_key')->first())->value;

        $resources = Resource::all();

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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:40',
            'units.*' => 'required|integer'
        ]);

        $resource = Resource::all()->first();
        $control_type = new ControlType('panic_button');

        $notification = Notification::make($resource,$control_type, $request->name);

        return WialonNotificationResource::make($notification);
    }
}
