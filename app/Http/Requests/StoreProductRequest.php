<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'category_id'     => ['required', 'exists:categories,id'],
            'sub_category_id' => ['nullable', 'exists:sub_categories,id'],
            'name'            => ['required', 'string', 'min:1', 'max:191'],
            'price'           => ['nullable', 'numeric'],
            'content'         => ['nullable', 'string', 'min:1'],
            'image'           => ['nullable', 'image', 'mimes:jpeg,jpg,JPG,png,webp,svg'],
            'is_active'       => ['nullable', 'boolean', 'in:0,1'],
        ];
    }
}
