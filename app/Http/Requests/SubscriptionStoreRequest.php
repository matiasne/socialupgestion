<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionStoreRequest extends FormRequest
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
            'enum_status' => 'required|string',
            'total_cost' => 'required|integer',
            'enum_pay_with' => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'client_id.required' => 'client_id is required!',
            'employe_id.required' => 'employe_id is required!',
            'start_date.required' => 'start_date is required!',
            'period.required' => 'period is required!',
            'enum_start_payment.required' => 'enum_start_payment is required!',
            'enum_status.required' => 'enum_status is required!',
            'total_cost.required' => 'total_cost is required!',
            'enum_pay_with' => 'enum_pay_with is required!'
        ];
    }

}
