<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize()
    {
        // Có thể thêm logic để kiểm tra quyền nếu cần thiết
        return true;
    }

    public function rules()
    {
        return [
            'rating' => 'required|integer|min:1|max:5',
            'comment' => [
                'nullable',
                'regex:/^[\pL\s\d]+$/u', // Chỉ chấp nhận chữ cái có dấu, chữ số và khoảng trắng
            ],
        ];
    }

    public function messages()
    {
        return [
            'rating.integer' => 'Rating phải là số nguyên.',
            'rating.required' => 'Bạn vẫn chưa đánh giá sản phẩm.',
            'rating.min' => 'Chỉ có thể đánh giá từ 1 đến 5 sao.',
            'rating.max' => 'Chỉ có thể đánh giá từ 1 đến 5 sao.',
            'comment.regex' => 'Nội dung đánh giá chỉ được bao gồm chữ cái, chữ số, khoảng trắng hoặc để trống.',
        ];
    }
}
