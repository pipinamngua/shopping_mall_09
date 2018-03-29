<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountPrograms extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required',
            'startedAt' => 'required',
            'endedAt' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'content.required' => ':attribute can not be null',
            'startedAt.required' => ':attribute can not be null',
            'endedAt.required' => ':attribute can not be null',
            'status.required' => ':attribute can not be null',
        ];
    }
}
