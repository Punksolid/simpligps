<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LogResource extends JsonResource
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
//        return parent::toArray($request);
        return [
            'id' => $this->id,
            'message' => $this->description,
            'level_name' => isset($this->properties['level']) ? $this->properties['level'] : 'info',
            'data' => $this->properties['attributes'] ?? '',
            'created_at' => "{$this->created_at->diffForHumans()} {$this->created_at->toDateTimeString()}",
        ];
    }
}
