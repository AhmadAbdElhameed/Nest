<?php

namespace App\Http\Requests\Admin\Brand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBrandRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('brand_translations', 'name')
                    ->where('locale', app()->getLocale()) // Adjust this if you handle multiple locales
            ],
            'slug' => 'required|string|max:255|unique:brands,slug',
            'image' => 'required|image|max:2000|mimes:jpeg,jpg,webp,png'
        ];
    }
}
