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
            'rp' => 'required',
            'invoice' => 'required',
            'client_id' => 'required|integer',
            'intermediates' => [
                'array',
                new NoTimeOverlap()
            ],
            'intermediates.*.place_id' => [
                "integer",
                "filled",
                'distinct'
            ],
            'intermediates.*.at_time' => [
                "date",
                "filled",
                'after:scheduled_load',
                'before:scheduled_arrival',
            ],
            'intermediates.*.exiting' => [
                "date",
                "filled",
                'after:scheduled_load',
                'before:scheduled_arrival'
            ],
            'origin_id' => 'required|integer',
            'destination_id' => 'required|integer',
            'mon_type' => 'required',
            'carrier_id' => 'required|integer',
            'truck_tract_id' => 'required|integer',
            'operator_id' => 'required|integer',

            'scheduled_load' => 'required|date',
            'scheduled_departure' => [
                'required',
                'date',
                'after:scheduled_load',
            ],
            'scheduled_arrival' => 'required|date|after:scheduled_departure',
            'scheduled_unload' => 'required|date|after:scheduled_arrival',
        ];
    }
}
