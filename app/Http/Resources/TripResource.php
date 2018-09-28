<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            "rp" => $this->rp,
            "invoice" => $this->invoice,
            "client" => $this->client,
            "intermediary" => $this->intermediary,
            "origin_id" => $this->origin_id,
            "destination_id" => $this->destination_id,
            "mon_type" => $this->mon_type,
            "line" => $this->line,
            "scheduled_load" => $this->scheduled_load,
            "scheduled_departure" => $this->scheduled_departure,
            "scheduled_arrival" => $this->scheduled_arrival,
            "scheduled_unload" => $this->scheduled_unload,
            "bulk" => $this->bulk,
            "tag" => $this->tag,
            "device_id" => $this->device_id,
            "convoy_id" => $this->convoy_id
        ];

    }
}