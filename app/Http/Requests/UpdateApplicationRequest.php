<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateApplicationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'type' => ['required', 'string'],
            'content' => ['required', 'string'],
            'attachments.*' => ['nullable', 'file', 'max:10240'], // 10MB max per file
            'remove_attachments' => ['nullable', 'array'],
            'remove_attachments.*' => ['exists:media,id'],
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Müraciət növü seçilməlidir',
            'content.required' => 'Müraciət məzmunu daxil edilməlidir',
            'attachments.*.max' => 'Fayl həcmi 10MB-dan çox ola bilməz',
        ];
    }
}
