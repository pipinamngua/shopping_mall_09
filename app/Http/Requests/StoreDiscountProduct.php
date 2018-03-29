<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountProduct extends FormRequest
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
            'productName' => 'required',
            'discountProgram' => 'required',
            'discountPercent' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'productName.required' => ':attribute can not be null',
            'discountProgram.required' => ':attribute can not be null',
            'discountPercent.required' => ':attribute can not be null',
        ];
    }
}
