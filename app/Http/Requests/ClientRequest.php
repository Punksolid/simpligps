<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'description' => 'required',
            'company_name' => 'required',
            'address' => 'required',
            'city' => 'required',
            'state' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'person_name' => 'required',
            'status' => 'required|bool',
            'email_frequency' => 'required|min:0|max:2'
        ];
    }
}
