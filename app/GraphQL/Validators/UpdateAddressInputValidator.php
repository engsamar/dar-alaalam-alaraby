<?php

namespace App\GraphQL\Validators;

use Nuwave\Lighthouse\Validation\Validator;

class UpdateAddressInputValidator extends Validator
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
            'title' => ['required', 'min:2', 'max:50'],
            'address' => ['required', 'min:2', 'max:50'],
            'city_id' => ['required', 'exists:cities,id,deleted_at,NULL'],
            'area_id' => ['required', 'exists:cities,id,deleted_at,NULL'],
            'address_id' => ['required', 'exists:addresses,id,deleted_at,NULL'],
        ];
    }

    public function messages(): array
    {
        \App::setLocale(\Request::header('Accept-Language'));

        return [

            'title.required' => trans('validation.required'),
            'city_id.required' => trans('validation.required'),
            'address.required' => trans('validation.required'),
            'area_id.required' => trans('validation.required'),


        ];
    }

    public function attributes(): array
    {
        return[
            'area_id' => trans('attributes.area_id'),
            'address_id' => trans('attributes.address_id'),
            'address' => trans('attributes.address'),
            'city_id' => trans('attributes.city_id'),
            'title' => trans('attributes.title'),
        ];
    }
}
