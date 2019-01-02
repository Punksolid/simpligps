<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            "name" => $this->nm,
            "id" => $this->id,
            "measure_units" => $this->mu,
            "position" => $this->when(isset($this->pos), [
                "lat" => optional($this->pos)->y,
                "lon" => optional($this->pos)->x
            ])
        ];

    }
}
