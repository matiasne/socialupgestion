<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceStoreRequest extends FormRequest
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
            'description' => 'required|string|max:500',
            'price' => 'required|integer',
            'id_commerce' => 'required|integer',
            'id_category' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required!',
            'description.required' => 'description is required!',
            'price.required' => 'price is required!',
            'id_commerce.required' => 'id_commerce is required!',
            'id_category.required' => 'id_category is required!'
        ];
    }
}
