<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LicenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     * @response   "data": array:15 [
     * 0 => {
     *  "name": "Cordie Witting IV"
     *  "description": "Et vel sit at. Non molestiae nihil sint voluptatem natus. Et quidem ea ratione qui assumenda nam."
     *  "lapse": 10
     *  "modules": "string_cambiar"
     *  "units": 10
     *  "number_active_sessions": 10
     *  "uuid": "e82b659d-5065-3caa-835a-cb433dce23ec"
     * }
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "description" => $this->description,
            "lapse" => $this->lapse,
            "modules" => $this->modules,
            "units" => $this->units,
            "number_active_sessions" => $this->number_active_sessions,
            "uuid" => $this->uuid,
            "accounts" => AccountResource::collection($this->whenLoaded('accounts'))
        ];
    }
}
