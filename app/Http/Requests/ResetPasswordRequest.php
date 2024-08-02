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
            'g-recaptcha-response' => 'required|captcha',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'code.required' => 'Vui lòng nhập mã xác thực.',
            'password.required' => 'Vui lòng nhập mật khẩu.',
            'password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'g-recaptcha-response.required' => 'Vui lòng xác thực Captcha.',
            'g-recaptcha-response.captcha' => 'Xác thực Captcha không thành công.',
        ];
    }
}
