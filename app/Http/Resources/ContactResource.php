<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            "name" => $this->name,
            "company" => $this->company,
            "phone" => $this->phone,
            "email" => $this->email,
            "address" => $this->address,
            "created_at" => $this->created_at->diffForHumans()
        ];
    }
}
