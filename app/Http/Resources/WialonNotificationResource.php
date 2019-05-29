<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WialonNotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @deprecated Usamos en cambio un NotificationTriggerResourceParaElementosLocales
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->n,
            'txt' => $this->txt,
            'control_type' => $this->trg,
            'actions' => $this->act,
            'resource' => $this->resource, //@todo
        ];
    }
}
