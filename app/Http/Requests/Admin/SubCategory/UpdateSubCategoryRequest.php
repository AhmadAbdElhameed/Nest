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
        $subCategoryId = $this->subCategory ? $this->subCategory->id : null;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sub_category_translations', 'name')
                    ->where(function ($query) use ($subCategoryId) {
                        return $query->where('locale', app()->getLocale())
                            ->where('sub_category_id', '!=', $subCategoryId);
                    })
            ],
            'slug' => 'required|string|max:255|unique:sub_categories,slug,' . $this->subCategory->id,
            'image' => 'nullable|image|max:2000|mimes:jpeg,jpg,webp,png'
        ];
    }
}
