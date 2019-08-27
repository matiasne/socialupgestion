<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeUpdateRequest extends FormRequest
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
            'name' => 'required|string',
            'surname' => 'required|string',
            'position' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'name is required for update!',
            'surname.required' => 'surname is required for update!',
            'position.required' => 'position is required for update!'
        ];
    }
}
