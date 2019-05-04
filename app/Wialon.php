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
use App\TruckTract as Truck; 

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
            if($this->deviceExists($wialon_unit))continue; // pasa a siguiente ciclo
            
            $device = Device::create([
                "name" => $wialon_unit->nm
            ]);

            $device->linkUnit($wialon_unit);
            $truck = Truck::create([
                'name' => $device->name,
                'device_id' => $device->id,
                'internal_number' => $device->uacl
            ]);

            $devices->push($device);
        }

        return $devices;
    }

    public function deviceExists(Unit $unit)
    {
        return Device::where('wialon_id', $unit->id)->exists();
    }

    public function importTrucks(): Collection
    {
        $wialon_units = Unit::all();
        $trucks = collect();
        dd($wialon_units->first());
        foreach ($wialon_units as $wialon_unit) {
            $truck = Truck::create([
                "name" => $wialon_unit->nm
            ]);

            $truck->linkUnit($wialon_unit);

            $trucks->push($truck);
        }

        return $trucks;
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