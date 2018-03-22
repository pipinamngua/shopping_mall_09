<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProducts extends FormRequest
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
            'product_name' => 'required',
            'description' => 'required',
            'original_price' => 'required|numeric',
            'category' => 'required',
            'image' => 'required',
            'status' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'image.image' => 'image must be an image'
        ];
    }
}
