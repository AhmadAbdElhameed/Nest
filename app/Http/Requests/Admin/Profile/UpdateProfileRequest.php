<?php

namespace App\Http\Requests\Admin\Profile;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfileRequest extends FormRequest
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
            'email' => 'required|string|max:255|unique:admins,email,' . $this->admin->id, // Ignore the current admin's ID
            'password' => 'nullable|min:8|confirmed'
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
