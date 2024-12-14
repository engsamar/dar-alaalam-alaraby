<?php

namespace App\Http\Requests;

class ContentRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                {
                    return [
                        'title.en' => 'required|string',
                        'title.ar' => 'required|string',

                    ];
                }
                // UPDATE
            case 'PUT':
            case 'PATCH':
                {
                    return [
                        'title.en' => 'required|string',
                        'title.ar' => 'required|string',


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