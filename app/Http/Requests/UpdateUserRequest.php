<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name' => ['required', 'alpha:ascii', 'max:255'],
            'email' => ['required', 'email', 'max:255'],
            'phone' => ['required', 'max:255'],
            'address_detail' => ['required', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'Please enter user email.',
            'email.email' => 'Please enter a valid email.',
            'name.required' => 'Please enter user name.',
            'phone.required' => 'Please enter user phone.',
            'address_detail.required' => 'Please enter user address detail.',
            // 'name.max' => 'User name max characters is 255.',
            'email.max' => 'User email max characters is 255.',
            'phone.max' => 'User phone max characters is 255.',
            'address_detail.max' => 'User address detail max characters is 255.',
        ];
    }
}
