<?php

namespace App\Api\Requests\InviteMember;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class InviteMemberRequest extends FormRequest
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
        $givenEmails = $this->emails;
        return [
            'emails'        => 'required|array',
            'emails.*'      => ['email', 'unique:users,email'],
            'account_type'  => ['required', 'numeric'],
        ];
    }
    public function messages()
    {
        return [
            'emails.required'       => 'The emails field is required.',
            'emails.array'          => 'The emails field must be array required.',
            'emails.*.email'        => ':input is not a valid email.',
            'emails.*.unique'       => ':input has already taken.',
            'role_id.required'      => 'The Account Type is required.',
            'role_id.numeric'       => 'The Account Type must be numeric.',
            // 'image' => 'Description is required',
        ];
    }

    public function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status_code'   => 400,
            'message'       => 'Validation errors',
            'data'          => $validator->errors()->first()
        ], 400));
    }

}
