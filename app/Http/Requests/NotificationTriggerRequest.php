<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class NotificationTriggerRequest extends FormRequest
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
            'name' => [
                'required',
            ],
            'devices_ids' => 'required|array',

            'level' => Rule::in([
                'emergency',
                'alert',
                'critical',
                'error',
                'warning',
                'notice',
                'info',
                'debug',
                ]),
            'active' => 'required|bool',
            'control_type' => 'required',
            'params.sensor_name' => 'required_if:control_type,sensor',
            // "params.sensor_type" => "required_if:control_type,sensor",
            'params.value_from' => 'required_if:control_type,sensor|integer',
            'params.value_to' => 'required_if:control_type,sensor|integer',
            'params.trigger_when' => 'required_if:control_type,sensor',
            'params.similar_sensor' => 'required_if:control_type,sensor',
        ];
    }
}

//         \Illuminate\Validation\Rule::unique('tenant.notification_triggers','name') // todo implement
