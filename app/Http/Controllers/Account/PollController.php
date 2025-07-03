<?php

namespace App\Http\Controllers\Account;

use App\Models\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePollVotesRequest;
use App\Models\PollVote;

class PollController extends Controller
{
    public function index()
    {
        $type = request()->routeIs('account.poll.survey') ? 'survey' : 'vote';
        
        $polls = Poll::query()
            ->where('type',$type)
            ->where(function($query){
                $query->where('target_user_type', auth()->user()->role)
                    ->orWhere('target_user_type','all');
            })
            ->withExists(['votes as is_voted' => function($query) {
                $query->where('user_id', auth()->id());
            }])
            ->get();
        return view('account.poll.index', [
            'title' => $type == 'survey' ? 'Sorğu' : 'Səsvermə',
            'polls' => $polls,
        ]);
    }

    public function show($id)
    {
        $poll = Poll::with(['questions.answers', 'votes' => function($query) {
            $query->where('user_id', auth()->id())
                ->select(['poll_id', 'question_id', 'answer_id']);
        }])
        ->where(function($query){
            $query->where('target_user_type', auth()->user()->role)
                ->orWhere('target_user_type','all');
        })
        ->withExists(['votes as is_voted' => function($query) {
            $query->where('user_id', auth()->id());
        }])
        ->findOrFail($id);

        $votes = $poll->votes->map(function($vote) {
            return [
                'question_id' => $vote->question_id,
                'answer_id' => $vote->answer_id,
            ];
        })->toArray();
            
        return view('account.poll.show', [
            'title' => $poll->title,
            'poll' => $poll,
            'isPollVoted' => $poll->is_voted,
            'votes' => $votes,
        ]);
    }

    public function submit(StorePollVotesRequest $request, $id)
    {
        $validated = $request->validated();
        $poll = $request->getPoll();
        $pollVotes = [];
        
        // Save answers
        foreach ($validated['question'] as $questionId => $answerId) {
           $pollVotes[] = [
                'poll_id' => $poll->id,
                'question_id' => $questionId,
                'answer_id' => $answerId,
                'user_id' => auth()->id(),
            ];
        }

        DB::table('poll_votes')->insert($pollVotes);
    
        return redirect()->route(
            $poll->type == 'vote' ? 'account.poll.vote' : 'account.poll.survey'
        )
            ->with('success', __('Poll submitted successfully.'));
    }
}
