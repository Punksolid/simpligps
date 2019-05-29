<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'description' => $this->description,
            'company_name' => $this->company_name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'phone' => (string) $this->phone,
            'email' => $this->email,
            'person_name' => $this->person_name,
            'status' => (bool) $this->status,
            'email_frequency' => (int) $this->email_frequency,
        ];
    }
}
