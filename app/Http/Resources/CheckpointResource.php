<?php

namespace App\Http\Resources;

use App\Timeline;
use Illuminate\Http\Resources\Json\JsonResource;

class CheckpointResource extends JsonResource
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
            'id' => $this->place->id,
            'name' => $this->place->name,
            'person_in_charge' => $this->place->person_in_charge,
            'address' => $this->place->address,
            'phone' => $this->place->phone,
            'high_risk' => $this->place->high_risk,
            'geofence_ref' => $this->place->geofence_ref,
            'at_time' => $this->at_time->toDateTimeString(),
            'exiting' => $this->exiting->toDateTimeString(),
            'real_at_time' => $this->real_at_time->toDateTimeString(),
            'real_exiting' => $this->real_exiting->toDateTimeString(),
            'status' => $this->getStatus(),
        ];
    }

    public function getStatus()
    {
        if (is_null($this->real_exiting) && is_null($this->real_exiting)) {
            return Timeline::NOT_YET_THERE;
        }
        if ($this->real_exiting && is_null($this->real_exiting)) {
            return Timeline::HERE_IT_IS;
        }
        if ($this->real_exiting && $this->real_exiting) {
            return Timeline::ALREADY_PASSED_HERE;
        }

        return abort(500);
    }
}
