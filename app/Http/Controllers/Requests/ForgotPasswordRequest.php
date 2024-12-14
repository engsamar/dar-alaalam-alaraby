<?php

namespace App\Http\Requests;

class ForgotPasswordRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        // CREATE ROLES
                        'mobile' => 'required|exists:users,mobile',
                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' =>'required|min:2',
                        'email' => 'required',
                        'mobile' => 'required',
                        'message' => 'required',
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
            // Validation messages
        ];
    }
}
