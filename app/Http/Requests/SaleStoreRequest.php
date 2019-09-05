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
            'products' => 'required|array',
            'total_cost' => 'required|integer',
            'enum_status' => 'required|string',
            'enum_pay_with' => 'required|string',
            'caja_id' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'client_id is required!',
            'employe_id.required' => 'employe_id is required!',
            'creation_date.required' => 'creation_date is required!',
            'description.required' => 'description is required!',
            'products.required' => 'products is required!',
            'total_cost.required' => 'total_cost is required!',
            'enum_status.required' => 'enum_status is required!',
            'caja_id.required' => 'caja_id is required!',
            'enum_pay_with' => 'enum_pay_with is required!',
            
        ];
    }
}
