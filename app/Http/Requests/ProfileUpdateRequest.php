<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
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
            'full_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id()) ],
            // 'gender' => ['nullable', 'in:0,1'],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'contact_numbers' => ['nullable', 'string', 'max:500'],
        ];
    }

    /**
     * Get custom attributes for validator errors.
     *
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'full_name' => 'tam ad',
            'email' => 'e-poçt',
            'gender' => 'cins',
            'birthdate' => 'doğum tarixi',
            'contact_numbers' => 'əlaqə nömrələri',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'full_name.required' => 'Tam ad sahəsi tələb olunur.',
            'full_name.max' => 'Tam ad 255 simvoldan çox ola bilməz.',
            'email.required' => 'E-poçt sahəsi tələb olunur.',
            'email.email' => 'Düzgün e-poçt formatı daxil edin.',
            'email.unique' => 'Bu e-poçt artıq istifadə olunur.',
            'gender.required' => 'Cins sahəsi tələb olunur.',
            'gender.in' => 'Cins sahəsi üçün düzgün dəyər seçin.',
            'birthdate.required' => 'Doğum tarixi tələb olunur.',
            'birthdate.date' => 'Düzgün tarix formatı daxil edin.',
            'birthdate.before' => 'Doğum tarixi bugünkü gündən əvvəl olmalıdır.',
            'contact_numbers.max' => 'Əlaqə nömrələri 500 simvoldan çox ola bilməz.',
        ];
    }
}
