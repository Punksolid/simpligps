<?php

namespace App\Http\Controllers;

use App\Http\Resources\WialonNotificationResource;
use App\Http\Resources\WialonResourceResource;
use App\Setting;
use Illuminate\Http\Request;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Resource;

class WialonController extends Controller
{
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
}
