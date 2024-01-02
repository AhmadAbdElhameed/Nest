<?php

namespace App\Http\Requests\Admin\Setting;

use Illuminate\Foundation\Http\FormRequest;

class UpdateShippingRuleRequest extends FormRequest
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
            'id' => 'required|exists:settings',
            'value' => 'required',
            'plain_value' => 'nullable|numeric',
        ];
    }

//    public function messages(){
//        return [
//            'email.required' => 'يجب ادخال البريد الالكتروني',
//            'email.email' => 'صيغة البريد الالكتروني غير صحيحة',
//            'password.required' => 'يجب ادخال كلمة المرور',
//        ];
//    }
}
