<?php

namespace App\Http\Requests;

class ProductRequest extends Request
{
    public function rules()
    {
        switch ($this->method()) {
            // CREATE
            case 'POST':
                $validate = [
                    'isbn' => 'required|string|unique:products,isbn',
                    'price' => 'required|numeric',
                ];

                foreach (\Illuminate\Support\Facades\Config::get('app.locales') as $locale) {
                    array_push($validate, ['title.'.$locale => 'required|string']);
                }

                return $validate;

                // UPDATE
            case 'PUT':
            case 'PATCH':
                $validate = [
                    'isbn' => 'required|string|unique:products,isbn,'.$this->id,
                    'price' => 'required|numeric',
                ];

                foreach (\Illuminate\Support\Facades\Config::get('app.locales') as $locale) {
                    array_push($validate, ['title.'.$locale => 'required|string']);
                }

                return $validate;

            case 'GET':
            case 'DELETE':
            default:
                return [];
        }
    }

    public function messages()
    {
        return [
        ];
    }
}
