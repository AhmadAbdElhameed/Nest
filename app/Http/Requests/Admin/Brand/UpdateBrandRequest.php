<?php

namespace App\Http\Requests\Admin\Brand;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBrandRequest extends FormRequest
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

        $brandId = $this->brand ? $this->brand->id : null;
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('brand_translations', 'name')
                    ->where(function ($query) use ($brandId) {
                        return $query->where('locale', app()->getLocale())
                            ->where('brand_id', '!=', $brandId);
                    })
            ],
            'slug' => 'required|string|max:255|unique:brands,slug,' . $this->brand->id,
            'image' => 'nullable|image|max:2000|mimes:jpeg,jpg,webp,png'
        ];
    }
}
