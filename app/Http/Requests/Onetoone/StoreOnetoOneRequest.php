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
            'first_member_id' => 'required',
            'second_member_id' => 'required',
            'onetoone_date' => 'required',
            'group_id' => 'required',
            'description' => ''
        ];
    }
}
