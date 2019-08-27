<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolStoreRequest extends FormRequest
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
            'name_rol' => 'required|string|max:100',
        ];
    }

    public function messages()
    {
        return [
            'name_rol.required' => 'name_rol is required!'
        ];
    }
}
