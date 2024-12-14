<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class DelegateRegisterInputValidator extends Validator
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
            'name' => ['required', 'min:2', 'max:50'],
            'password' => ['required', 'min:6', 'confirmed'],

            'email' => [
                'required',
                'unique:users,email,NULL,id,deleted_at,NULL',
                'email:rfc,dns',
                'bail',
            ],
            'mobile' => ['nullable', 'min:6', 'unique:users,mobile,NULL,id,deleted_at,NULL'],
            'plate_number' => ['required'],
            'letter_plate_number' => ['required'],
            'serial_plate_number' => ['required'],
            'driving_license' => ['required'],
            'car_license' => ['required'],
            'national_id' => ['required'],
            'iban' => ['required'],
            'city_id' => ['required','exists:cities,id'],
            'area_id' => ['required','exists:cities,id'],
            'nationality_id' => ['required','exists:contents,id'],
            'car_type_id' => ['required','exists:contents,id'],
            'bank_id'=> ['required','exists:contents,id'],
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
            'password.required' => trans('validation.required'),
            'password.confirmed' => trans('validation.confirmed'),

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
