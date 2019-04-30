<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Sabberworm\CSS\Rule\Rule;

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
            "name" => [
                "required"
//                \Illuminate\Validation\Rule::unique('tenant.notification_triggers','name') // todo implement
            ],
            "devices_ids" => 'required|array',
            "level" => '',
            "active" => 'required|bool'
        ];
    }
}
