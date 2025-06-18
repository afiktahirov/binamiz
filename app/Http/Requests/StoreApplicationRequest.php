<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreApplicationRequest extends FormRequest
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
            'type' => 'required|string',
            'department' => 'required|string',
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachments' => 'array|max:5',
            'attachments.*' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function after(): array
    {
        return [
            function ($validator) {
                $totalSize = collect($this->file('attachments'))->sum(function ($file) {
                    return $file->getSize();
                });

                if ($totalSize > 2 * 1024 * 1024) {
                    $validator->errors()->add('attachments', 'Ümumi fayl həcmi 10MB-dan çox olmamalıdır.');
                }
            }
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
            'type' => 'Müraciət növü',
            'department' => 'Müraciət Bölməsi',
            'title' => 'Başlıq',
            'content' => 'Müraciət mətni',
            'attachments.*' => 'Hərbir Fayl'
        ];
    }

}
