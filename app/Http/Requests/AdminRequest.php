<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AdminRequest extends Request
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
                        Rule::unique('admins', 'email'),
                    ],
                    'mobile' => [
                        'required',
                        Rule::unique('admins', 'mobile'),
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
                        Rule::unique('admins', 'email')->ignore($this->admin),
                    ],
                    'mobile' => [
                        'required',
                        Rule::unique('admins', 'mobile')->ignore($this->admin),
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