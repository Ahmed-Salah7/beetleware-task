<?php

namespace App\Http\Requests\Api;

use App\Http\Requests\Api\ApiFormRequest;

class CreateTransactionRequest extends ApiFormRequest
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
                'amount' => ['required'],
                'payer_id' => ['required','exists:users,id'],
                'due_on' => ['required'],
                'is_vat_inclusive' => ['required'],
                'vat' => ['required_if:is_vat_inclusive,1'],
            ];
    }

    public function messages(): array
    {
        return [
            'amount.required' => __('amount is required'),
            'payer_id.required' => __('payer is required'),
            'payer_id.exists' => __('payer not exists'),
            'due_on.required' => __('due_on is required'),
            'is_vat_inclusive.required' => __('is_vat_inclusive is required'),
            'vat.required' => __('vat is required'),

         ];
    }
}
