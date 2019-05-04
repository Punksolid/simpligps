<?php

namespace App\Http\Resources;

use App\Carrier;
use Illuminate\Http\Resources\Json\JsonResource;

class TruckTractResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'plate' => $this->plate,
            'model' => $this->model,
            'internal_number' => $this->internal_number,
            'brand' => $this->brand,
            'gps' => $this->gps,
            'color' => $this->color,
            'carrier_id' => $this->carrier_id,
            'device_id' => $this->device_id,
            'operator_id' => $this->operator_id,

            "carrier" => DeviceResource::make($this->whenLoaded('carrier')),
            "device" => DeviceResource::make($this->whenLoaded('device')),
            "operator" => DeviceResource::make($this->whenLoaded('operator')),

            'created_at' => $this->when($request->route()->name('trucktracts.show'), $this->created_at->toDateTimeString()),
            'updated_at' => $this->when($request->route()->name('trucktracts.show'), $this->updated_at->toDateTimeString())
        ];
    }
}
