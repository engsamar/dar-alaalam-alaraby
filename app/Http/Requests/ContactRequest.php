<?php

namespace App\Http\Requests;

class ContactRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'name' => 'required|string',
                        'email' => 'required|string|email',
                        'mobile' => 'required|string',
                        'message' => 'required|string',
                        // 'g-recaptcha-response' => 'required|recaptchav3:register,0.5',
                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'name' => 'required|string',
                        'email' => 'required|string',


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
