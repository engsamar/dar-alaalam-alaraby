<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class StoreRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                $validate =  [
                    'email' => [
                        'required',
                        Rule::unique('stores', 'email'),
                    ],
                    'phone' => [
                        'required',
                        Rule::unique('stores', 'phone'),
                    ],
                    'password' => 'required|confirmed|min:8'
                ];
]
                foreach (\Illuminate\Support\Facades\Config::get('app.locales') as $locale) {
                    array_push($validate, ['title.'.$locale => 'required|string']);
                }

                return $validate;

                // UPDATE
            case 'PUT':
            case 'PATCH':
                $validate =  [
                    'email' => [
                        'required',
                        Rule::unique('stores', 'email'),
                    ],
                    'phone' => [
                        'required',
                        Rule::unique('stores', 'phone'),
                    ],
                    'password' => 'required|confirmed|min:8'
                ];
]
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
