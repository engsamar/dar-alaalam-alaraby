<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class DeleteAddressInputValidator extends Validator
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
            'address_id' => ['required', 'exists:addresses,id,deleted_at,NULL'],
        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [
            'address_id.required' => trans('validation.required'),

        ];
    }

    public function attributes(): array
    {
        return[
            'address_id' => trans('attributes.address'),
        ];
    }
}
