<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleStoreRequest extends FormRequest
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
     */
    public function rules()
    {
        return [
            'client_id' => 'required|integer',
            'employe_id' => 'required|integer',
            'creation_date' => 'required|date',
            'description' => 'required|string|max:150',
            'products' => 'required|array'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'client_id is required!',
            'employe_id.required' => 'employe_id is required!',
            'creation_date.required' => 'creation_date is required!',
            'description.required' => 'description is required!',
            'products.required' => 'products is required!'
            
        ];
    }
}