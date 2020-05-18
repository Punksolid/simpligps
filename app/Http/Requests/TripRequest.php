<?php

namespace App\Http\Requests;

use App\Rules\NoTimeOverlap;
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
//            'rp' => 'required', // No requerido en plan de viaje, si para inicializar el viaje
//            'invoice' => 'required', // No requerido para el plan de viaje, si para inicializar el viaje
            'client_id' => 'required|integer',

            'intermediates.*.place_id' => [
                'integer',
                'filled',
                'distinct',
            ],
            'intermediates.*.at_time' => [
                'date',
                'filled',
                'after:scheduled_load',
                'after:scheduled_departure',
                'before:scheduled_arrival',
            ],
            'intermediates.*.exiting' => [
                'date',
                'filled',
                'after:scheduled_load',
                'before:scheduled_arrival',
            ],
            'intermediates' => [
                'array',
                new NoTimeOverlap(),
            ],
            'origin_id' => 'required|integer',
            'destination_id' => 'required|integer',
            'mon_type' => 'required',
            'carrier_id' => [
//                'required', // No requerido en plan de viaje, si al inicializar el viaje
                'nullable',
                'present',
                'integer',
            ],
            'truck_tract_id' => [
//                'required', // No requerido en plan de viaje, si al inicializar el viaje
                'nullable',
                'integer',
            ],
            'operator_id' => [
//                'required', // No requerido en plan de viaje, si al inicializar el viaje
                'nullable',
                'integer',
            ],
            'scheduled_load' => 'required|date',
            'scheduled_departure' => [
                'required',
                'date',
                'after:scheduled_load',
            ],
            'scheduled_arrival' => 'required|date|after:scheduled_departure', // 2020-05-19T02:13:00.000Z
            'scheduled_unload' => 'required|date|after:scheduled_arrival',
            'trailers_ids' => [
                'array',
                'nullable'
            ]
        ];
    }
}
