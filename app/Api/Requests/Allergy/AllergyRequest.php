<?php

namespace App\Api\Requests\Allergy;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AllergyRequest extends FormRequest
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
            'data.*.name' => 'required|max:50',
            'data.*.image' => '',
        ];
    }
    public function messages()
    {
        return [
            'data.*.name.required' => 'Allergy name is required.',
            'data.*.name.max' => 'The Allergy name must not be greater than 50 characters.',
            // 'image' => 'Description is required',
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
