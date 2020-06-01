<?php

namespace App\Http\Controllers;

use App\Http\Resources\WialonNotificationResource;
use Illuminate\Http\Request;
use App\Http\Requests\WialonNotificationRequest;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Unit;
use Punksolid\Wialon\Resource;
use Punksolid\Wialon\ControlType;
use Punksolid\Wialon\GeofenceControlType;

class WialonNotificationsController extends Controller
{


    /**
     * Create Wialon Notification.
     *
     * @param Request $request
     *
     * @return WialonNotificationResource|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     *
     * @deprecated Ya no se crean notificaciones directamente, se crean por NotificationTriggers y ellas crean en wialon
     * su propio manejador
     *
     * @throws \Punksolid\Wialon\WialonErrorException
     * @throws \Exception
     */
    public function store(WialonNotificationRequest $request)
    {
        $resource = Resource::find($request->resource_id);
        if ('geofence' === $request->control_type) {
            $control_type = new GeofenceControlType();
            $control_type->addGeozoneId($request->params['geofence_id']);
        } else {
            $control_type = new ControlType($request->control_type, $request->params);
        }
        $units = Unit::findMany($request->units);
        $action = new Notification\Action('push_messages', [
            'url' => url(config('app.url').'api/v1/webhook/alert'),
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
        X-Tenant-Id='.$request->header('X-Tenant-Id').'
        "';

        $text = str_replace(["\r", "\n", ' '], '', $text);

        $notification = Notification::make($resource, $units, $control_type, $request->name, $action, [
            'txt' => $text,
        ]);

        return WialonNotificationResource::make($notification);
    }

}
