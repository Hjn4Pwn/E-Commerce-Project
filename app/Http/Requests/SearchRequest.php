<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'search' => 'nullable|regex:/^[a-zA-Z]{2,}$/'
        ];
    }

    public function messages()
    {
        return [
            'search.regex' => 'Chỉ được phép tìm kiếm bằng chữ cái a-zA-Z và tối thiểu 2 kí tự.'
        ];
    }
}
