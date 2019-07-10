<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
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
            'rp' => $this->rp,
            'folio' => $this->folio,
            'invoice' => $this->invoice,
            'client_id' => $this->client_id,
            'client_name' => optional($this->client)->company_name,

            'origin_id' => $this->origin_id,
            'origin_name' => optional($this->origin)->name,
            'destination_name' => optional($this->origin)->name,
            'destination_id' => $this->destination_id,
            'stops' => $this->intermediates()->count(),
            'mon_type' => $this->mon_type,
            'carrier_id' => $this->carrier_id,
            'truck_tract_id' => $this->truck_tract_id,
            'truck_name' => optional($this->truck)->name,

            'operator_id' => $this->operator_id,
            'scheduled_load' => optional($this->scheduled_load)->format("Y/m/d H:i"),
            'scheduled_departure' => optional($this->scheduled_departure)->format("Y/m/d H:i"),
            'scheduled_arrival' => optional($this->scheduled_arrival)->format("Y/m/d H:i"),
            'scheduled_unload' => optional($this->scheduled_unload)->format("Y/m/d H:i"),
            'real_departure' => $this->real_departure,
            'real_arrival' => $this->real_arrival,
            'bulk' => $this->bulk,
            'tag' => $this->tag,
            'device_id' => $this->device_id,
            'convoy_id' => $this->convoy_id,
            'georoute_ref' => $this->georoute_ref,
            // Relationship Objects
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'truck' => TruckTractResource::make($this->whenLoaded('truck')),
            'operator' => OperatorResource::make($this->whenLoaded('operator')),
            'origin' => PlaceResource::make($this->whenLoaded('origin')),
            'destination' => PlaceResource::make($this->whenLoaded('destination')),
            'device' => DeviceResource::make($this->whenLoaded('device')),
            'intermediates' => PlaceResource::collection($this->whenLoaded('intermediates')),
            'trailers' => TrailerBoxResource::collection($this->whenLoaded('trailers')),
            'client' => ClientResource::make($this->whenLoaded('client')),
        ];
    }
}
