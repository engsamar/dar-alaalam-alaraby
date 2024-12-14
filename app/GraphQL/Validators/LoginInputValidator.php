<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class LoginInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'mobile' => ['required', 'exists:users,mobile', 'phone:auto'],
            'password' => ['required']
        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [
            'mobile.required' => trans('validation.required'),
            'mobile.phone' => trans('validation.mobile.phone'),
            'mobile.unique' => trans('validation.mobile.unique'),
            'email.unique' => trans('validation.custom.email.unique'),
            'email.email' => trans('validation.custom.email.email'),
        ];
    }
}
