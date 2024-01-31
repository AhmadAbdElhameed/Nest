<?php

namespace App\Http\Requests\Admin\Slider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSliderRequest extends FormRequest
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
        $sliderId = $this->slider ? $this->slider->id : null;
        return [
            'image' => 'nullable|image|max:2048|mimes:jpg,jpeg,png,webp',
            'slug' => 'required|string|max:255|unique:sliders,slug,' . $this->slider->id,
            'title' => ['required','string','max:255',Rule::unique('slider_translations','title')
                ->where(function ($query) use ($sliderId) {
                    return $query->where('locale', app()->getLocale())
                        ->where('slider_id', '!=', $sliderId);
                })],
            'sub_title' => ['required','string','max:255',Rule::unique('slider_translations','sub_title')
                ->where(function ($query) use ($sliderId) {
                    return $query->where('locale', app()->getLocale())
                        ->where('slider_id', '!=', $sliderId);
                })],
        ];
    }
}
