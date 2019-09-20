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
            'period'=> 'required|integer',
            'enum_status' => 'required|string',
            'total_cost' => 'required|integer',
        ];
    }

    public function messages()
    {
        return [
            'period.required' => 'period is required for update!',
            'enum_status.required' => 'enum_status is required for update!',
            'total_cost.required' => 'total_cost is required for update!',
        ];
    }
}
