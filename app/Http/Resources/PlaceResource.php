<?php

namespace App\Http\Resources;

use App\Timeline;
use Illuminate\Http\Resources\Json\JsonResource;

class PlaceResource extends JsonResource
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
            'person_in_charge' => $this->person_in_charge,
            'address' => $this->address,
            'phone' => $this->phone,
            'high_risk' => $this->high_risk,
            'geofence_ref' => $this->geofence_ref,
            'checkpoint_id' => $this->whenPivotLoaded('places_trips', function () {
                return $this->pivot->id;
            }),
            'at_time' => $this->whenPivotLoaded('places_trips', function () {
                return optional($this->pivot->at_time)->toDateTimeString();
            }),
            'exiting' => $this->whenPivotLoaded('places_trips', function () {
                return optional($this->pivot->exiting)->toDateTimeString();
            }),
            'real_at_time' => $this->whenPivotLoaded('places_trips', function () {
                return optional($this->pivot->real_at_time)->toDateTimeString();
            }),
            'real_exiting' => $this->whenPivotLoaded('places_trips', function () {
                return optional($this->pivot->real_exiting)->toDateTimeString();
            }),
            'status' => $this->whenPivotLoaded('places_trips', function () {
                if (is_null($this->pivot->real_exiting) && is_null($this->pivot->real_exiting)) {
                    return Timeline::NOT_YET_THERE;
                } elseif ($this->pivot->real_exiting && is_null($this->pivot->real_exiting)) {
                    return Timeline::HERE_IT_IS;
                } elseif ($this->pivot->real_exiting && $this->pivot->real_exiting) {
                    return Timeline::ALREADY_PASSED_HERE;
                }
                abort(500);
            }),
        ];
    }
}
