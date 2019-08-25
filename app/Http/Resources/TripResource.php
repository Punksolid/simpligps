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

            'origin_name' => optional($this->getOrigin())->name,

            'destination_name' => optional($this->getDestination())->name,
            'stops' => $this->intermediates()->count(),
            'mon_type' => $this->mon_type,
            'carrier_id' => $this->carrier_id,
            'truck_tract_id' => $this->truck_tract_id,
            'truck_name' => optional($this->truck)->name,

            'operator_id' => $this->operator_id,
            'scheduled_load' => $this->origin ? $this->origin->pivot->at_time->toDateTimeString() : null,
            'scheduled_departure' => $this->origin ? $this->origin->pivot->exiting->toDateTimeString() : null,
            'scheduled_arrival' => $this->destination ? $this->destination->pivot->at_time->toDateTimeString() : null,
            'scheduled_unload' => $this->destination ? $this->destination->pivot->exiting->toDateTimeString() : null,

            'real_departure' => $this->real_departure,
            'real_arrival' => $this->real_arrival,
            'bulk' => $this->bulk,
            'tag' => $this->tag,
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
