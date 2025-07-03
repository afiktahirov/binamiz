<?php

namespace App\Http\Requests;

use App\Models\Poll;
use Illuminate\Foundation\Http\FormRequest;

class StorePollVotesRequest extends FormRequest
{
    protected $poll;

    public function authorize(): bool
    {
        // $this->poll = Poll::with('questions')->findOrFail($this->route('id'));
        
        // // Check if poll has expired
        // if (now()->gt($this->poll->expires_at)) {
        //     return false;
        // }

        return true;
    }

    public function rules(): array
    {
        $this->poll = Poll::with('questions')->findOrFail($this->route('id'));
        
        foreach ($this->poll->questions as $question) {
            $rules["question.{$question->id}"] = 'required|exists:poll_answers,id';
        }

        return $rules;
    }

    public function messages(): array
    {
        $messages = [];

        foreach ($this->poll->questions as $question) {
            $messages["question.{$question->id}.required"] = __("Please answer the question: :question", ['question' => $question->question]);
            $messages["question.{$question->id}.exists"] = __("Invalid answer selected for question: :question", ['question' => $question->question]);
        }

        return $messages;
    }

    public function getPoll(): Poll
    {
        return $this->poll;
    }
}