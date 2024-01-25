<?php

namespace App\Http\Requests\Admin\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductPriceRequest extends FormRequest
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
            "price" => "required|min:0|numeric",
            "special_price" => "nullable|numeric",
            "special_price_type" => "required_with:special_price|in:percent,fixed",
            "special_price_start" => "required_with:special_price|date_format:Y-m-d",
            "special_price_end" => "required_with:special_price|date_format:Y-m-d",
        ];
    }
}
