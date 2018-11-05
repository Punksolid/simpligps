<?php

namespace App\Http\Resources;

use App\Carrier;
use Illuminate\Http\Resources\Json\JsonResource;

class OperatorResource extends JsonResource
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
            "name" => $this->name,
            "phone" => $this->phone,
            "active" => (bool)$this->active,
            "carrier" => CarrierResource::make($this->whenLoaded("carrier"))
        ];

    }
}
