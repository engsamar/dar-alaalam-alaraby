<?php

namespace App\Http\Requests;

class ProductSettingsRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'sizes.quantity' => 'required|array',
                        'sizes.price' => 'required|array',

                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [

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
