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
            'phone' => 'required|string|max:20',
            'province_id' => 'required|string|max:255',
            'district_id' => 'required|string|max:255',
            'ward_id' => 'required|string|max:255',
            'address_detail' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:900',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Tên là bắt buộc.',
            'name.string' => 'Tên phải là một chuỗi ký tự.',
            'name.max' => 'Tên không được vượt quá :max ký tự.',

            'phone.required' => 'Số điện thoại là bắt buộc.',
            'phone.string' => 'Số điện thoại phải là một chuỗi ký tự.',
            'phone.max' => 'Số điện thoại không được vượt quá :max ký tự.',

            'province_id.required' => 'Tỉnh/thành phố là bắt buộc.',
            'province_id.string' => 'Tỉnh/thành phố phải là một chuỗi ký tự.',
            'province_id.max' => 'Tỉnh/thành phố không được vượt quá :max ký tự.',

            'district_id.required' => 'Quận/huyện là bắt buộc.',
            'district_id.string' => 'Quận/huyện phải là một chuỗi ký tự.',
            'district_id.max' => 'Quận/huyện không được vượt quá :max ký tự.',

            'ward_id.required' => 'Phường/xã là bắt buộc.',
            'ward_id.string' => 'Phường/xã phải là một chuỗi ký tự.',
            'ward_id.max' => 'Phường/xã không được vượt quá :max ký tự.',

            'address_detail.required' => 'Địa chỉ chi tiết là bắt buộc.',
            'address_detail.string' => 'Địa chỉ chi tiết phải là một chuỗi ký tự.',
            'address_detail.max' => 'Địa chỉ chi tiết không được vượt quá :max ký tự.',

            'avatar.image' => 'Ảnh đại diện phải là một hình ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng: :values.',
            'avatar.max' => 'Ảnh đại diện không được vượt quá :max KB.',
        ];
    }
}
