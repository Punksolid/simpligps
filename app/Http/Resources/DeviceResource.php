<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use OpenApi\Annotations\Property;
use OpenApi\Annotations\Schema;

class DeviceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     *
     * @Schema(
     *     schema="device",
     *     @Property(property="id"),
     *     @Property(property="name"),
     *     @Property(property="gps"),
     *     @Property(property="brand"),
     *     @Property(property="model"),
     *     @Property(property="internal_number"),
     *     @Property(property="truck"),
     *     @Property(property="position"),
     *     @Property(property="reference_data"),
     *     @Property(property="is_connected")
     * )
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gps' => $this->gps,
            'brand' => $this->brand,
            'model' => $this->model,
            'internal_number' => $this->internal_number,
            'truck' => $this->whenLoaded('deviceable'),
            'position' => $this->position,
            'reference_data' => $this->reference_data,
            'is_connected' => $this->when($request->routeIs('*.show'), $this->isConnected()),
        ];
    }
}
