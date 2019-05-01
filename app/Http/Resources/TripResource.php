<?php

namespace App\Http\Resources;

use App\Convoy;
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

            "origin_id" => $this->origin_id,
            "origin_name" => optional($this->origin)->name,
            "destination_name" => optional($this->origin)->name,
            "destination_id" => $this->destination_id,
            "mon_type" => $this->mon_type,
            "carrier_id" => $this->carrier_id,
            "truck_tract_id" => $this->truck_tract_id,
            "operator_id" => $this->operator_id,
            "scheduled_load" => $this->scheduled_load,
            "scheduled_departure" => $this->scheduled_departure,
            "scheduled_arrival" => $this->scheduled_arrival,
            "scheduled_unload" => $this->scheduled_unload,
            "bulk" => $this->bulk,
            "tag" => $this->tag,
            "device_id" => $this->device_id,
            "convoy_id" => $this->convoy_id,
            "georoute_ref" => $this->georoute_ref,
            // Relationship Objects
            "truck" => TruckTractResource::make($this->whenLoaded('truck')),
            "operator" => OperatorResource::make($this->whenLoaded('operator')),
            "origin" => PlaceResource::make($this->whenLoaded('origin')),
            "destination" => PlaceResource::make($this->whenLoaded('destination')),
            "device" => DeviceResource::make($this->whenLoaded('device')),
            "intermediates" => PlaceResource::collection($this->whenLoaded('intermediates')),
            "trailers" => TrailerBoxResource::collection($this->whenLoaded('trailers')),
        ];


    }
}
