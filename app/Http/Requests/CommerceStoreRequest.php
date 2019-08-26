<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommerceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     * 
     */


    public function rules()
    {
        return [
            //
            'name' => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'phone_number' => 'required|string|max:100'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required!',
            'address.required' => 'address is required!',
            'phone_number.required' => 'phone_number is required!'
        ];
    }
}
