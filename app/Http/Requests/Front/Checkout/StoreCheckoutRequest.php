<?php

namespace App\Http\Requests\Front\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCheckoutRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|email:dns|max:255',
            'city' => ['required','string', Rule::in(['dubai', 'abu_dhabi', 'sharjah', 'ajman',
                'umm_al_quwain', 'ras_al_khaimah', 'fujairah'])],
            'phone' => 'required|string',
            'address' => 'required|string|max:255',
            'notes' => 'sometimes|nullable|string|max:500',
            'payment_method' => ['required', Rule::in(['stripe', 'cod','myfatoorah'])],
        ];
    }
}
