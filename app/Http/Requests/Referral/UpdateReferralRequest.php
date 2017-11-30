<?php

namespace App\Http\Requests\Referral;

use Illuminate\Foundation\Http\FormRequest;

class UpdateReferralRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('referral-update');
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
            'to_contact_id' => 'required',
            'referral_date' => 'required',
            'group_id' => 'required',
            'meeting_id' =>'',
            'referral_id' =>'',
            'description' => ''
        ];
    }
}
