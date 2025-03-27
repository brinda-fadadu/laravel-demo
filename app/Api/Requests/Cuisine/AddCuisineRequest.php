<?php

namespace App\Api\Requests\Cuisine;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddCuisineRequest extends FormRequest
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
        if(!empty($this->data)) {
            return [
                'data.*.name' => 'required|max:50',
                'data.*.description' => 'max:250',
            ];
        } else {
            return [
                'name' => 'required|max:50',
                'description' => 'max:250',
            ];
        }
    }
    public function messages()
    {
        if(!empty($this->data)) {
            return [
                'data.*.name.required' => 'Course name is required.',
                'data.*.name.max' => 'The name must not be greater than 50 characters.',
                'data.*.description.max' => 'The description must not be greater than 250 characters.'
            ];
        } else {
            return [
                'name.required' => 'Course name is required.',
                'name.max' => 'The name must not be greater than 50 characters.',
                'description.max' => 'The description must not be greater than 250 characters.'
            ];
        }
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
