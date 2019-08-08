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
            'truck' => $this->whenLoaded('deviceable'),
            'position' => $this->position,
            'reference_data' => $this->reference_data,
            'is_connected' => $this->when($request->routeIs('*.show'), $this->is_connected)
        ];
    }
}
