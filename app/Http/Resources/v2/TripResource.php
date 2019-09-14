<?php

namespace App\Http\Resources\V2;

use App\Http\Resources\CarrierResource;
use App\Http\Resources\CheckpointResource;
use App\Http\Resources\ClientResource;
use App\Http\Resources\DeviceResource;
use App\Http\Resources\OperatorResource;
use App\Http\Resources\TagResource;
use App\Http\Resources\TrailerBoxResource;
use App\Http\Resources\TruckTractResource;
use App\Log;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {

        return [
            'id' => $this->id,
            'rp' => $this->rp,
            'invoice' => $this->invoice,
            'mon_type' => $this->mon_type,

            'stops' => $this->checkpoints_count,

            'client_id' => $this->client_id,
            'carrier_id' => $this->carrier_id,
            'truck_tract_id' => $this->truck_tract_id,
            'operator_id' => $this->operator_id,
            'bulk' => $this->bulk,
            'convoy_id' => $this->convoy_id,
            'georoute_ref' => $this->georoute_ref,

            // Relationship Objects
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'truck' => TruckTractResource::make($this->whenLoaded('truck')),
            'operator' => OperatorResource::make($this->whenLoaded('operator')),
            'origin' => CheckpointResource::make($this->whenLoaded('originCheckpoint')),
            'destination' => CheckpointResource::make($this->whenLoaded('destinationCheckpoint')),
            'device' => DeviceResource::make($this->whenLoaded('device')),
            'intermediates' => CheckpointResource::collection($this->whenLoaded('checkpoints')),
            'trailers' => TrailerBoxResource::collection($this->whenLoaded('trailers')),
            'client' => ClientResource::make($this->whenLoaded('client')),
            'carrier' => CarrierResource::make($this->whenLoaded('carrier')),
        ];

    }
}
