<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class MakePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "cardNumber" =>  'nullable|numeric',
            "ccv" => 'nullable|numeric',
            "expirationDate" => 'nullable|numeric',
            "amount" => 'required|numeric',
            "order_id" => 'required|numeric',
        ];
    }
}
