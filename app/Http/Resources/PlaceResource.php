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
            "high_risk" => $this->high_risk,
            "geofence_ref" => $this->geofence_ref,
            "at_time" => $this->whenPivotLoaded('places_trips', function () {
                return $this->pivot->at_time;
            }),
            "exiting" => $this->whenPivotLoaded('places_trips', function () {
                return $this->pivot->exiting;
            }),
            "real_at_time" => $this->whenPivotLoaded('places_trips', function () {
                return $this->pivot->real_at_time;
            }),
            "real_exiting" => $this->whenPivotLoaded('places_trips', function () {
                return $this->pivot->real_exiting;
            }),
            "status" => $this->whenPivotLoaded('places_trips', function () {
                if (is_null($this->pivot->real_exiting) && is_null($this->pivot->real_exiting)){
                    return 0;
                } elseif ($this->pivot->real_exiting && is_null($this->pivot->real_exiting)){
                    return 1;
                } elseif ($this->pivot->real_exiting && $this->pivot->real_exiting) {
                    return 2;
                }
                abort(500);
            }),
        ];
    }
}
