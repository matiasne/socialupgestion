<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClosingStoreRequest extends FormRequest
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
            'caja_id' => 'required|integer',
            'date_closing' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'caja_id.required' => 'caja_id is required!',
            'date_closing.required' => 'date_closing is required!',
        ];
    }
}
