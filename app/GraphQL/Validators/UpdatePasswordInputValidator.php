<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class UpdatePasswordInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            // TODO Add your validation rules

            'password' => ['required', 'min:6', 'confirmed'],
            'old_password' => ['required', 'min:6'],

        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [
            'password.required' => trans('validation.required'),
            'old_password.required' => trans('validation.required'),
            'password.confirmed' => trans('validation.confirmed'),

        ];
    }

    public function attributes(): array
    {
        return[
            'old_password' => trans('attributes.old_password'),
            'password' => trans('attributes.password'),
        ];

    }
}
