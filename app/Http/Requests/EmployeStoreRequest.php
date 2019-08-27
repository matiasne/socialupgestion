<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeStoreRequest extends FormRequest
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
            'commerce_id' => 'required|integer',
            'surname' => 'required|string|max:100',
            'position' => 'required|string|max:100'
        ];
    }


    public function messages()
    {
        return [
            'name.required' => 'name is required!',
            'commerce_id.required' => 'commerce_id is required!',
            'surname.required' => 'surname is required!',
            'position.required' => 'position is required!'
        ];
    }
}
