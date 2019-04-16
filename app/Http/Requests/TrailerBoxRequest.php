<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TrailerBoxRequest extends FormRequest
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
            'internal_number' => 'required',
            'carrier_id' => 'integer',
            'gps' => 'required',
            'plate' => 'required'
        ];
    }
}
