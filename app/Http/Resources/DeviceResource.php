<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gps' => $this->gps,
            'brand' => $this->brand,
            'model' => $this->model,
            'internal_number' => $this->internal_number,
            'trips' => $this->whenLoaded('trips'),
            'truck' => $this->whenLoaded('truck'),
            'position' => [
                'lat' => $this->getLocation()['lat'],
                'lon' => $this->getLocation()['lon']
            ],
            'reference_data' => $this->reference_data,
        ];
    }
}
