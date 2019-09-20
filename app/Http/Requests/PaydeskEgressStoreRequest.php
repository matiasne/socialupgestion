<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PaydeskEgressStoreRequest extends FormRequest
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
            'total' => 'required|integer',
            'payment_id' => 'required|integer'
 
        ];
    }

    public function messages()
    {
        return [
            'total.required' => 'total is required!',
            'payment_id.required' => 'payment_id is required for update!'
        ];
    }
}

