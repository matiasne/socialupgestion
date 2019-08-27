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
     * 'commerce_id',
        'name',        
     */


    public function rules()
    {
        return [
            //
            'commerce_id' => 'required|integer',
            'name' => 'required|string|max:200',
        ];
    }

    public function messages()
    {
        return [
            'commerce_id.required' => 'commerce_id is required!',
            'name.required' => 'name is required!',
        ];
    }
}
