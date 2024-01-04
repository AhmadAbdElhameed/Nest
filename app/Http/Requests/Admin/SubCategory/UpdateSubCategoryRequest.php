<?php

namespace App\Http\Requests\Admin\SubCategory;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubCategoryRequest extends FormRequest
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
            'category_id' => 'required|exists:categories,id',
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_category_translations', 'name')
                    ->where('locale', app()->getLocale()) // Adjust this if you handle multiple locales
            ],
            'slug' => 'required|string|max:255|unique:sub_categories,slug,'. $this->subCategory->id,
            'image' => 'nullable|image|max:2000|mimes:jpeg,jpg,webp,png'
        ];
    }
}
