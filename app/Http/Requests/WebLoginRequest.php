<?php

namespace App\Http\Requests;

class WebLoginRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                    'full' => 'required|exists:users,mobile',
                    'password' => 'required|min:8',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [];
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
            // Validation messages
        ];
    }
}
