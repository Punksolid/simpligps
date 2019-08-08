<?php


namespace App\Traits;

use App\Device;

trait Deviceable
{
    /**
     * Un tracto tiene un dispositivo.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function device()
    {
        return $this->morphOne(Device::class, 'deviceable');
    }

    public function assignDevice(Device $device)
    {
//        if ($device->)
//        return $device->deviceable()->associate($this);
        return $this->device()->save($device);
//        return $this->update(['device_id' => $device->id]);
    }

    public function getLocation():array
    {
        if ($this->device) {
            return $this->device->getLocation();
        }

        return [
            'lat' => null,
            'lon' => null
        ];
    }

    public function verifyConnection()
    {
        return $this->device->linked(true);
    }
}
