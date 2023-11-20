<?php

namespace App\Http\Requests\Api;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;
class ApiFormRequest extends FormRequest
{

    public function failedValidation(Validator $validator)
    {

        if ($this->expectsJson()) {
            $errors = (new ValidationException($validator))->errors();
            throw new HttpResponseException(
                response()->badRequest($errors)
            );
        }

        parent::failedValidation($validator);
    }
}
