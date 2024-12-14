<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class ResetPasswordByCodeInputValidator extends Validator
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

            'mobile' => [
                'required',
                'exists:users,mobile,deleted_at,NULL', 'phone:auto'
            ],
        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [
            'mobile.unique' => trans('validation.custom.mobile.unique'),
            'password.required' => trans('validation.required'),
            'password.confirmed' => trans('validation.confirmed'),

        ];
    }

    public function attributes(): array
    {
        return[
            'mobile' => trans('attributes.mobile'),
            'code' => trans('attributes.code'),
            'password' => trans('attributes.password'),
        ];

    }
}
