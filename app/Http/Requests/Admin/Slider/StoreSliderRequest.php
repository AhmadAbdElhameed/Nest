<?php

namespace App\Http\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class StoreSliderRequest extends FormRequest
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
            'image' => 'required|image|max:2048|mimes:jpg,jpeg,png,webp',
            'slug' => 'required|string|max:255|unique:sliders,slug',
            'title' => ['required','string','max:255',Rule::unique('slider_translations','title')
            ->where('locale',app()->getLocale())],
            'sub_title' => ['required','string','max:255',Rule::unique('slider_translations','sub_title')
                ->where('locale',app()->getLocale())],
        ];
    }
}
