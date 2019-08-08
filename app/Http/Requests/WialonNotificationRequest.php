<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\RequiredIf;

class WialonNotificationRequest extends FormRequest
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
            'name' => 'required|max:40',
            'units.*' => 'required|integer',
            'control_type' => [
                'required',
                Rule::in([
                    'speed',
                    'panic_button',
                    'parameter_in_a_message',
                    'connection_loss',
                    'sms',
                    'address',
                    'fuel_filling',
                    'driver',
                    'passenger_alarm',
                    'geofence',
                    'digital_input',
                    'sensor_value',
                    'idling',
                    'interposition_of_units',
                    'excess_of_messages',
                    'fuel_theft',
                    'passenger_activity',
                    'maintenance',
                ]),
            ],
            'params' => [
                Rule::requiredIf(function () {
                    return 'panic_button' != request()->control_type;
                }),
            ],
            // params logic, required_if es necesario para cada tipo de control type de notificacion
            'params.geofence_id' => 'required_if:control_type,geofence',
            'resource_id' => 'required',

            /*Depending on control type this conditions apply*/
        ];
    }
}
