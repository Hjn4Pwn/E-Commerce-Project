<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($this->user()->id),
            ],
            'phone' => 'nullable|string|max:20',
            'province_id' => 'nullable|string|max:255',
            'district_id' => 'nullable|string|max:255',
            'ward_id' => 'nullable|string|max:255',
            'address_detail' => 'nullable|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            // 'email.required' => 'Please enter user email.',
            // 'email.email' => 'Please enter a valid email.',
            // 'name.required' => 'Please enter user name.',
            // 'phone.required' => 'Please enter user phone.',
            // 'address_detail.required' => 'Please enter user address detail.',
            // // 'name.max' => 'User name max characters is 255.',
            // 'email.max' => 'User email max characters is 255.',
            // 'phone.max' => 'User phone max characters is 255.',
            // 'address_detail.max' => 'User address detail max characters is 255.',
        ];
    }
}
