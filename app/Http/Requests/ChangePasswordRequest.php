<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        return [
            'current_password' => 'required',
            'new_password' => 'required|confirmed|min:6',
            'role' => 'required|string',
            'code' => 'required|string',
            'g-recaptcha-response' => 'required|captcha',

        ];
    }

    public function messages()
    {
        return [
            'current_password.required' => 'Vui lòng nhập mật khẩu cũ.',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới.',
            'new_password.confirmed' => 'Mật khẩu xác nhận không khớp.',
            'new_password.min' => 'Mật khẩu mới tối thiểu phải có 6 kí tự.',
            'code.required' => 'Mã xác thực là bắt buộc.',
            'g-recaptcha-response.required' => 'Vui lòng xác thực Captcha.',
            'g-recaptcha-response.captcha' => 'Xác thực Captcha không thành công.',
        ];
    }
}
