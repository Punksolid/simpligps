<?php

namespace App\Jobs\Traccar;

use App\Device;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Config;
use Javleds\Traccar\Facades\Client;
use Javleds\Traccar\Models\Device as TraccarDevice;

class ImportDevices implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Device
     */
    private $device;

    /**
     * Create a new job instance.
     *
     */
    public function __construct()
    {

    }

    /**
     * Iterates each traccar device and attach it to Device
     *
     * @return void
     */
    public function handle()
    {
        $traccar_units = $this->allTraccarDevices();
        $devices = collect();

        /** @var TraccarDevice $traccar_unit */
        foreach ($traccar_units as $traccar_unit) {
            if ($this->deviceExists($traccar_unit)){
                continue;
            }

            $device = Device::create($traccar_unit->toArray());
            $this->linkUnit($device, $traccar_unit);

            $devices->push($device);

        }

        return $devices;
    }

    public function allTraccarDevices()
    {
        $response = Client::get(config('traccar.base_url') . 'devices');

        return TraccarDevice::hydrate($response);
    }

    private function deviceExists(TraccarDevice $traccar_unit): bool
    {
        return Device::query()->where('wialon_id', $traccar_unit->getId())->exists();
    }

    private function linkUnit(Device $device, TraccarDevice $traccar_unit): bool
    {
        return (bool) $device->update([
           'wialon_id' => $traccar_unit->getId(),
           'reference_data' => $traccar_unit
        ]);
    }
}
