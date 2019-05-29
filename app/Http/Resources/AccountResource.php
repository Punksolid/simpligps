<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'easyname' => $this->easyname,
            'uuid' => $this->uuid,
            //relationships
            'users' => UsersResource::collection($this->whenLoaded('users')),
            'licenses' => LicenseResource::collection($this->whenLoaded('licenses')),
            'wialon_key' => $this->when($request->route()->named('accounts.show'), $this->wialon_key),
            'integrity' => $this->when($request->route()->named('accounts.show'), $this->hasDatabaseAccesible()),
            //@todo agregar contador de dias faltantes para expirar
//            "expires_in" => $this->whenPivotLoaded("licenses_accounts", function (){
//
//                return $this->pivot->expires_at;
//            })
        ];
    }
}
