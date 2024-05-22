<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'image1' => 'image|mimes:jpeg,jpg,png,webp|max:2048',
            'category_id' => 'required',
            'flavors' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'quantity_sold' => 'integer',
            'sale' => 'integer',
            'short_description' => 'required',
            'description' => 'required',
        ];
    }

    public function attributes(): array
    {
        return [
            'image1' => 'primary image',
        ];
    }
}
