<?php

namespace App\Api\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users|max:255',
        ];
    }

    public function messages()
    {
        return [
            'email.unique' => 'The email has already been taken.',
            'email.max' => 'The email must not be greater than 255 characters.',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 400,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ],400));
    }
}
