<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TruckTractRequest extends FormRequest
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
            'name' => 'required',
            'plate' => 'required',
            'model' => 'required',
            'internal_number' => 'required',
            'brand' => 'required',
            'gps' => 'required',
            'color' => 'required',
            'carrier_id' => 'required|integer',
            'device_id' => 'required|integer'
        ];
    }
}
