<?php

namespace App\Http\Requests\Onetoone;

use Illuminate\Foundation\Http\FormRequest;

class StoreOnetoOneRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('onetoone-create');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_contact_id' => 'required',
            'second_contact_id' => 'required|different:first_contact_id',
            'onetoone_date' => 'required',
            'group_id' => 'required',
            'meeting_id' => '',
            'description' => ''
        ];
    }

    public function messages()
    {
        return [
            'second_contact_id.different' => 'Cannot be same person.'
        ];
    }
}
