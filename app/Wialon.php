<?php
/**
 * Created by PhpStorm.
 * User: ze
 * Date: 3/10/19
 * Time: 11:11 PM
 */

namespace App;


use Illuminate\Support\Collection;
use Punksolid\Wialon\Notification;
use Punksolid\Wialon\Unit;

class Wialon
{
    public $token;

    public function __construct($token)
    {
        $this->token = $token;
        config(["services.wialon.token" => $token]);
    }

    public function import(): Collection
    {
        $wialon_units = Unit::all();
        $devices = collect();
        foreach ($wialon_units as $wialon_unit){
            $device = factory(Device::class)->create(["name" => $wialon_unit->nm]);

            $device->linkUnit($wialon_unit);

            $devices->push($device);
        }

        return $devices;
    }

    public function importNotifications()
    {
        $notifications = Notification::all();
        $notifications_triggers = collect();
        foreach ($notifications as $notification){
            $notifications_triggers->push(NotificationTrigger::create([
                "name" => $notification->n,
                "active" => false
            ]));
        }

        return $notifications_triggers;
    }
}