<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionUpdateRequest extends FormRequest
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
            'start_date' => 'required|date',
            'period'=> 'required|integer',
            'enum_start_payment' => 'required|string',
            'total_cost' => 'required|integer'
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'client_id is required for update!',
            'employe_id.required' => 'employe_id is required for update!',
            'start_date.required' => 'start_date is required for update!',
            'period.required' => 'period is required for update!',
            'enum_start_payment.required' => 'enum_start_payment is required for update!',
            'total_cost.required' => 'total_cost is required for update!'
        ];
    }
}