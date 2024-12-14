<?php

namespace App\Http\Requests;

class SubscribeRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'email' => 'required|string|email',
                        // 'g-recaptcha-response' => 'required|recaptchav3:register,0.5',
                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
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
