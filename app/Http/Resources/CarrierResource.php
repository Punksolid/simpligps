<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarrierResource extends JsonResource
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
            "id" => $this->id,
            "carrier_name" => $this->carrier_name,
            "contact_name" => $this->contact_name,
            "phone" => $this->phone,
            "email" => $this->email,
        ];
    }
}
