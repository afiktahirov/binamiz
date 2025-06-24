@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Polls</h6>
                </div>
                <div class="card-body">
                    @foreach($polls as $poll)
                        <div class="card mb-4">
                            <div class="card-header">
                                <h5>{{ $poll->title }}</h5>
                                <p class="text-sm">Expires: {{ \Carbon\Carbon::parse($poll->expires_at)->format('M d, Y') }}</p>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('account.poll.submit', $poll->id) }}" method="POST">
                                    @csrf
                                    @foreach($poll->questions as $question)
                                        <div class="mb-4">
                                            <label class="form-label">{{ $question->question }}</label>
                                            @foreach($question->answers as $answer)
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" 
                                                           name="question[{{ $question->id }}]" 
                                                           value="{{ $answer->id }}" 
                                                           id="answer{{ $answer->id }}">
                                                    <label class="form-check-label" for="answer{{ $answer->id }}">
                                                        {{ $answer->answer }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endforeach
                                    <button type="submit" class="btn btn-primary">Submit Poll</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection