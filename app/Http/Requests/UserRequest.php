<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class UserRequest extends Request
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
                        Rule::unique('users', 'email'),
                    ],
                    'mobile' => [
                        'required',
                        Rule::unique('users', 'mobile'),
                    ],
                    'name' => 'required|string',
                    'password' => 'required|confirmed|min:6',
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
                        Rule::unique('users', 'email')->ignore($this->user),
                    ],
                    'mobile' => [
                        'required',
                        Rule::unique('users', 'mobile')->ignore($this->user),
                    ],
                    'name' => 'required|string',
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