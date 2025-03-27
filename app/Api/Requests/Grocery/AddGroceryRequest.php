<?php

namespace App\Api\Requests\Grocery;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddGroceryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'groceries' => 'required|array',
            'groceries.*.name' => 'nullable|string',
            'groceries.*.unit' => 'nullable|string',
            'groceries.*.amount' => 'nullable|numeric',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 400,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 400));
    }
}
