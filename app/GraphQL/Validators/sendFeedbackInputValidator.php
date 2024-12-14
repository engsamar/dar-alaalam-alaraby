<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class SendFeedbackInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        return [
            'name' => ['required'],
            'email' => ['required', 'email'],
            'mobile' => ['required'],
            'message' => ['required'],
        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [
            'name.required' => trans('validation.required'),
            'email.required' => trans('validation.required'),
            'email.email' => trans('validation.custom.email.email'),
            'mobile.required' => trans('validation.required'),
            'message.required' => trans('validation.required'),
        ];
    }
}
