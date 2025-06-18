@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">

            <div class="card-body">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $poll->title }}</h5>
                        <p class="text-sm">Expires: {{ \Carbon\Carbon::parse($poll->expires_at)->format('M d, Y') }}</p>
                    </div>
                    <div class="card-body">
                        @if($isPollVoted)
                            <div class="alert alert-info mb-4">
                                You have already voted in this poll.
                            </div>
                        @endif
                        <form method="POST" {{ $isPollVoted ? 'class=voted-form' : '' }}>
                            @csrf
                            @foreach($poll->questions as $question)
                                <div class="mb-4">
                                    <label class="form-label @error('question.' . $question->id) text-danger @enderror">{{ $question->question }}</label>
                                    @foreach($question->answers as $answer)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" 
                                                    name="question[{{ $question->id }}]" 
                                                    value="{{ $answer->id }}" 
                                                    id="answer{{ $answer->id }}"
                                                    {{ $isPollVoted ? 
                                                        (collect($votes)->where('question_id', $question->id)->where('answer_id', $answer->id)->isNotEmpty() ? 'checked' : '') 
                                                        : (old('question.' . $question->id) == $answer->id ? 'checked' : '') }}
                                                    {{ $isPollVoted ? 'disabled' : '' }}>
                                            <label class="form-check-label" for="answer{{ $answer->id }}">
                                                {{ $answer->answer }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            @endforeach
                            @if(!$isPollVoted)
                                <button type="submit" class="btn btn-primary">Submit Poll</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($isPollVoted)
<style>
    .voted-form {
        pointer-events: none;
        opacity: 0.9;
    }
</style>
@endif
@endsection