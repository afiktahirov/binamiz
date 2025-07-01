<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ];
    }
    
    public function messages(): array
    {
        return [
            'current_password.required' => 'Hazırkı şifrə tələb olunur.',
            'new_password.required' => 'Yeni şifrə tələb olunur.',
            'new_password.min' => 'Yeni şifrə ən azı 6 simvoldan ibarət olmalıdır.',
            'new_password.confirmed' => 'Yeni şifrə təsdiqlə uyğun gəlmir.',
        ];
    }
}
