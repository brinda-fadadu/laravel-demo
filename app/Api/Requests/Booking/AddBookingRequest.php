<?php

namespace App\Api\Requests\Booking;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AddBookingRequest extends FormRequest
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
            'selected_user_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'time' => ['required', 'regex:/^([01][0-9]|2[0-3]):[0-5][0-9]$|^(0[1-9]|1[0-2]):[0-5][0-9] ?(AM|PM)$/i'],
            'description' => 'nullable|string|max:250',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'selected_user_id.required' => 'The selected user ID is required.',
            'selected_user_id.exists' => 'The selected user ID must exist in the users table.',
            'date.required' => 'The booking date is required.',
            'date.date' => 'The booking date must be a valid date.',
            'time.required' => 'The booking time is required.',
            'time.date_format' => 'The booking time must be in the format HH:MM.',
            'description.string' => 'The description must be a string.',
            'description.max' => 'The description must not be greater than 250 characters.',
        ];
    }

    /**
     * Handle a failed validation attempt.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     */
    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code' => 400,
            'message' => 'Validation errors',
            'data' => $validator->errors()
        ], 400));
    }

}
