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
            {
                return [

                    'email' => [
                        'required',
                        Rule::unique('stores', 'email'),
                    ],
                    'phone' => [
                        'required',
                        Rule::unique('stores', 'phone'),
                    ],
                    'title.en' => 'required|string',
                    'title.ar' => 'required|string',
                    'password' => 'required|confirmed|min:8',


                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    // UPDATE ROLES
                    'email' => [
                        'required',
                        Rule::unique('stores', 'email')->ignore($this->item),
                    ],
                    'phone' => [
                        'required',
                        Rule::unique('stores', 'phone')->ignore($this->item),
                    ],
                    'title.ar' => 'required|string',
                    'title.en' => 'required|string',

                ];
            }
            case 'GET':
            case 'DELETE':
            default:
            {
                return [];
            }
        }
    }

    public function messages()
    {
        return [

        ];
    }
}
