<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaleUpdateRequest extends FormRequest
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
            'caja_id' => 'required|integer',
            'enum_pay_with' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'client_id is required for update!',
            'employe_id.required' => 'employe_id is required for update!',
            'creation_date.required' => 'creation_date is required for update!',
            'description.required' => 'description is required for update!',
            'products.required' => 'products is required for update!',
            'total_cost.required' => 'total_cost is required for update!',
            'enum_status.required' => 'enum_status is required for update!',
            'caja_id.required' => 'caja_id is required!',
            'enum_pay_with' => 'enum_pay_with is required!'
        ];
    }
}
