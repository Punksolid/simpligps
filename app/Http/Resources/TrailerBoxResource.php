<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TrailerBoxResource extends JsonResource
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
            'carrier_name' => optional($this->carrier)->carrier_name,
            'internal_number' => $this->internal_number,
            'plate' => $this->plate,
            'gps' => $this->gps,
            'carrier_id' => $this->carrier_id,
            'device_id' => $this->device_id,
        ];
    }
}
