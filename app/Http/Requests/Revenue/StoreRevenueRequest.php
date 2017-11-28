<?php

namespace App\Http\Requests\Revenue;

use Illuminate\Foundation\Http\FormRequest;

class StoreRevenueRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('revenue-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contact_id' => 'required',
            'amount' => 'required',
            'report_date' => 'required',
            'group_id' => 'required',
            'description' => ''
        ];
    }
}
