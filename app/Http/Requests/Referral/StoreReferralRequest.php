<?php

namespace App\Http\Requests\Referral;

use Illuminate\Foundation\Http\FormRequest;

class StoreReferralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('referral-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'from_contact_id' => 'required',
            'to_contact_id' => 'required|different:from_contact_id',
            'referral_date' => 'required',
            'group_id' => 'required',
            'meeting_id' =>'',
            'referral_id' =>'',
            'description' => ''
        ];
    }

    public function messages()
    {
        return [
            'to_contact_id.different' => 'From and To cannot be same person.'
        ];
    }
}
