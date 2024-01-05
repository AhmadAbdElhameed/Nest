<?php

namespace App\Http\Requests\Admin\Category;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
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
        $categoryId = $this->category ? $this->category->id : null;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('category_translations', 'name')
                    ->where(function ($query) use ($categoryId) {
                        return $query->where('locale', app()->getLocale())
                            ->where('category_id', '!=', $categoryId);
                    })
            ],
            'slug' => 'required|string|max:255|unique:categories,slug,' . $this->category->id,
            'image' => 'nullable|image|max:2000|mimes:jpeg,jpg,webp,png'
        ];
    }
}
