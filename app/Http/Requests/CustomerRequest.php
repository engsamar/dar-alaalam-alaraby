<?php

namespace App\Http\Requests;

class CustomerRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
            {
                return [
                    // CREATE ROLES
                    'name' =>'required|min:2',
                    'email' => 'sometimes|unique:users,email',
                    'mobile' => 'required|unique:users,mobile',
                    'password' => 'required|min:8|confirmed',
                ];
            }
            // UPDATE
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' =>'required|min:2',
                    'mobile' =>'required|min:2',
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
