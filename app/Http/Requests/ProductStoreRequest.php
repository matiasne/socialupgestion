<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     * 
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
            'stock' => 'required|integer',
            'price' => 'required|integer',
            'commerce_id' => 'required|integer',
            'provider_id' => 'required|integer',
            'category_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required!',
            'description.required' => 'description is required!',
            'stock.required' => 'stock is required!',
            'price.required' => 'price is required!',
            'commerce_id.required' => 'commerce_id is required!',
            'provider_id.required' => 'provider_id is required!',
            'category_id.required' => 'category_id is required!'
        ];
    }
}
