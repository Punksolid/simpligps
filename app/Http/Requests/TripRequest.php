<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "rp" => "required",
            "invoice" => "required",
            "client" => "required",
//            "intermediary",
            "origin" => "required",
            "destination" => "required",
            "mon_type" => "required",
            "line" => "required",

            "scheduled_load" => "required|date", //@todo preguntar si la carga es antes de la salida o hay salida antes
            "scheduled_departure" => "required|date|before:scheduled_arrival",
            "scheduled_arrival" => "required|date|after:scheduled_departure",
            "scheduled_unload" => "required|date|after:scheduled_arrival",
        ];
    }
}
