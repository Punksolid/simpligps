<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GeofenceResource extends JsonResource
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
            'id' => "{$this->rid}_{$this->id}", // dando un id unico separado por guion bajo, igual al usado por wialon
            'resource_id' => $this->rid,
            'name' => $this->n,
            'description' => $this->d
        ];
    }
}
