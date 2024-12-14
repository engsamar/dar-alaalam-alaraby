<?php

namespace App\GraphQL\Validators;

use App\Exceptions\CustomErrorHandler;
use Nuwave\Lighthouse\Validation\Validator;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

class UpdateProfileInputValidator extends Validator
{
    /**
     * Return the validation rules.
     *
     * @return array<string, array<mixed>>
     */
    public function rules(): array
    {
        $user = auth()->user();
        if(! $user){
            throw new AuthenticationException('Unauthenticated.', [[], 'sanctum']);
        }
        return [
            // TODO Add your validation rules
            'name' => ['required', 'min:2', 'max:50'],
            'email' => [
                'required',
                'unique:users,email,' . $user->id . ',id,deleted_at,NULL',
                'email:rfc,dns',
                'bail',
            ],
            'mobile' => ['nullable', 'min:6', 'unique:users,mobile,' . $user->id . ',id,deleted_at,NULL', 'phone:auto'],
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

    public function attributes(): array
    {
        return[
            'mobile' => trans('attributes.mobile'),
            'name' => trans('attributes.name'),
            'email' => trans('attributes.email'),
            'password' => trans('attributes.password'),
        ];
    }
}
