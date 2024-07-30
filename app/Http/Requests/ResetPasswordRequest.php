<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ResetPasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                // Rule::unique('users')->ignore(Auth::id()),
            ],
            'password' => 'required|confirmed|min:6',
            'role' => 'required|string',
            'code' => 'required|string',
        ];

        return $rules;
    }
}
