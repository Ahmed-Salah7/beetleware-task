<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\ApiFormRequest;

class CreatePaymentRequest extends ApiFormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
            return [
                'transaction_id' => ['required','exists:transactions,id'],
                'amount' => ['required'],
                'paid_on' => ['required'],
            ];
    }

    public function messages(): array
    {
        return [
            'transaction_id.required' => __('Transaction Id is required'),
            'transaction_id.exists' => __('Transaction Id not exists'),
            'amount.required' => __('amount is required'),
            'paid_on.required' => __('Paid On is required'),
         ];
    }
}
