<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class ForgotPasswordInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'mobile' => [
                'required',
                'exists:users,mobile,deleted_at,NULL', 'phone:auto'
            ]
        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [
            'mobile.required' => trans('validation.required'),
            'mobile.exists' => trans('validation.exists'),
        ];
    }

    public function attributes(): array
    {
        return[
            'mobile' => trans('attributes.mobile'),
        ];
    }
}
