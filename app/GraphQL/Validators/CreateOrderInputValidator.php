<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class CreateOrderInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'address' => [
                'required',
                'exists:addresses,id',
            ],
            'payment_method' => ['required']

        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [
            'payment_method.required' => trans('validation.required'),
            'address.required' => trans('validation.required'),
            'address.exists' => trans('validation.exists'),
        ];
    }
}
