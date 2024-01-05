<?php

namespace App\Http\Requests\Admin\Tag;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTagRequest extends FormRequest
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

        $tagId = $this->tag ? $this->tag->id : null;
        return [

            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('tag_translations', 'name')
                    ->where(function ($query) use ($tagId) {
                        return $query->where('locale', app()->getLocale())
                            ->where('tag_id', '!=', $tagId);
                    })
            ],
            'slug' => 'required|string|max:255|unique:tags,slug,' . $this->tag->id,
        ];
    }
}
