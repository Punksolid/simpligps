<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class NotificationTriggerResource extends JsonResource
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
            'active' => $this->active,
            'devices' => $this->devices->pluck('name')->implode(', '),
            'txt' => $this->txt,
            'control_type' => $this->control_type,
            'level' => $this->level,
            'actions' => $this->resource->act,
            'resource' => $this->resource, //@todo
        ];
    }
}
