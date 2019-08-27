<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryStoreRequest extends FormRequest
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
     * 'id_commerce',
        'name',        
     */


    public function rules()
    {
        return [
            //
            'id_commerce' => 'required|integer',
            'name' => 'required|string|max:200',
        ];
    }

    public function messages()
    {
        return [
            'id_commerce.required' => 'id_commerce is required!',
            'name.required' => 'name is required!',
        ];
    }
}
