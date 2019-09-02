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
            'provider_id' => 'required|integer',
            'category_id' => 'required|integer',
            'imgproduct' => 'required|mimes:jpeg,bmp,png,jpg',
            'code' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required!',
            'description.required' => 'description is required!',
            'stock.required' => 'stock is required!',
            'price.required' => 'price is required!',
            'provider_id.required' => 'provider_id is required!',
            'category_id.required' => 'category_id is required!',
            'imgproduct.required' => 'imgproduct is required!',
            'code.required' => 'code is required!'
        ];
    }
}
