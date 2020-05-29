<?php


namespace App;


use App\Device;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Javleds\Traccar\Facades\Client;

class Traccar
{
    public function import(): Collection
    {
        $wialon_units = Unit::all();
        $devices = collect();
        foreach ($wialon_units as $wialon_unit) {
            if ($this->deviceExists($wialon_unit)) {
                continue;
            } // pasa a siguiente ciclo

            $device = Device::create([
                'name' => $wialon_unit->nm,
            ]);
            $device->linkUnit($wialon_unit);
            $this->createTruckAndAttachDevice($device);

            $devices->push($device);
        }

        return $devices;
    }


}