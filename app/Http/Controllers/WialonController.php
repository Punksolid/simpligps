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

    public function deleteNotification($id)
    {
        $notification = Notification::all()->where("id",$id)->first();

        if ($notification->destroy()){
            return response()->json([
                "message" => "Success"
            ]);
        }

        return response()->json([
            "message" => "Error deleting notification"
        ]);
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
            "url" => url(config("app.url").'api/v1/webhook/alert')
        ]);

        $text = '"unit=%UNIT%&
        timestamp=%CURR_TIME%&
        location=%LOCATION%&
        last_location=%LAST_LOCATION%&
        locator_link=%LOCATOR_LINK(60,T)%&
        smallest_geofence_inside=%ZONE_MIN%&
        all_geofences_inside=%ZONES_ALL%&
        UNIT_GROUP=%UNIT_GROUP%&
        SPEED=%SPEED%&
        POS_TIME=%POS_TIME%&
        MSG_TIME=%MSG_TIME%&
        DRIVER=%DRIVER%&
        DRIVER_PHONE=%DRIVER_PHONE%&
        TRAILER=%TRAILER%&
        SENSOR=%SENSOR(*)%&
        ENGINE_HOURS=%ENGINE_HOURS%&
        MILEAGE=%MILEAGE%&
        LAT=%LAT%&
        LON=%LON%&
        LATD=%LATD%&
        LOND=%LOND%&
        GOOGLE_LINK=%GOOGLE_LINK%&
        CUSTOM_FIELD=%CUSTOM_FIELD(*)%&
        UNIT_ID=%UNIT_ID%&
        MSG_TIME_INT=%MSG_TIME_INT%&
        NOTIFICATION=%NOTIFICATION%&
        X-Tenant-Id='.$request->tenant_account->uuid.'
        "';

        $text = str_replace(["\r","\n"," "], "", $text);

        $notification = Notification::make($resource, $units, $control_type, $request->name, $action, [
            "txt" => $text
        ]);

        return WialonNotificationResource::make($notification);
    }
}
