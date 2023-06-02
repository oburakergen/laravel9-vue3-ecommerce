<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddToCardRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'productId' => "required",
            'quantity' => "required|integer|between:1,10",
            'userId' => "required",
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'productId.required' => 'The product not found',
            'quantity.required' => 'A quantity required',
            'quantity.between' => 'The :attribute value :input is not between :min - :max.',
            'userId.required' => 'User not found. Please page refresh',
        ];
    }
}
