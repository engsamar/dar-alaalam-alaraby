<?php

namespace App\Http\Requests;

class CityRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                $validate = [];

                foreach (\Illuminate\Support\Facades\Config::get('app.locales') as $locale) {
                    array_push($validate, ['title.'.$locale => 'required|string']);
                }

                return $validate;

                // UPDATE
            case 'PUT':
            case 'PATCH':
                $validate = [];

                foreach (\Illuminate\Support\Facades\Config::get('app.locales') as $locale) {
                    array_push($validate, ['title.'.$locale => 'required|string']);
                }

                return $validate;

            case 'GET':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
        ];
    }
}
