<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AccessLogResource extends JsonResource
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
            "description" => $this->description,
            "message" => "{$this->description} {$this->causer->email} {$this->created_at->diffForHumans()}",
            "created_at" => $this->created_at->toDateTimeString()
        ];
        /**
                "id" => 1,
                "log_name" => "default",
                "description" => "Logging Test",
                "subject_id" => null,
                "subject_type" => null,
                "causer_id" => 1,
                "causer_type" => "App\User",
                "properties" => Illuminate\Support\Collection {#3876
                all: [],
                },
                "created_at" => "2019-05-21 08:29:26",
                "updated_at" => "2019-05-21 08:29:26",
                "causer" => [
                "id" => 1,
                "name" => "Ms. Brielle Crooks",
                "email" => "punksolid@gmail.com",
                "created_at" => "2019-05-04 23:07:23",
                "updated_at" => "2019-05-04 23:07:23",
                "email_verified_at" => null,
                "lastname" => "Albin Kshlerin",
                ],
                "subject" => null,
         */
    }
}
