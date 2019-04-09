<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
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
            "name" => $this->name,
            "person_in_charge" => $this->person_in_charge,
            "address" => $this->address,
            "phone" => $this->phone,
            "geofence_ref" => $this->geofence_ref
        ];
    }
}
