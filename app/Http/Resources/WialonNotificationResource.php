<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WialonNotificationResource extends JsonResource
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
          "name" => $this->n,
            "txt" => $this->txt,
            "control_type" => $this->trg,
            "actions" => $this->act,
            "resource" => "resource" //@todo
        ];

    }
}
