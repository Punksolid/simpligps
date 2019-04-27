<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationTriggerResource extends JsonResource
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
            "name" => $this->name,
            'active' => $this->active,
            "txt" => $this->txt,
            "control_type" => $this->resource->trg,
            "actions" => $this->resource->act,
            "resource" => $this->resource //@todo
        ];
    }
}
