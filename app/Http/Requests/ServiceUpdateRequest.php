<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceUpdateRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'price' => 'required|integer',
            'category_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required for update!',
            'description.required' => 'description is required for update!',
            'price.required' => 'price is required for update!',
            'category_id.required' => 'category_id is required for update!'
        ];
    }
}
