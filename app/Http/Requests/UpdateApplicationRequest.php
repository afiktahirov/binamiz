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
            'title' => ['required','string','max:100'],
            'type' => ['required', 'string'],
            'content' => ['required', 'string', 'max:1000'],
            'attachments.*' => ['nullable', 'file', 'max:10240'], // 10MB max per file
            'remove_attachments' => ['nullable', 'array'],
            'remove_attachments.*' => ['exists:media,id'],
            'comment' => ['nullable','string']
        ];
    }

    public function messages()
    {
        return [
            'type.required' => 'Müraciət növü seçilməlidir',
            'content.required' => 'Müraciət məzmunu daxil edilməlidir',
            'title.required' => 'Müraciət başlığı daxil edilməlidir',
            'attachments.*.max' => 'Fayl həcmi 10MB-dan çox ola bilməz',
        ];
    }
}
