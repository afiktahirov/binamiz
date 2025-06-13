<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollVote extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'poll_id',
        'question_id',
        'answer_id',
        'user_id',
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }

    public function pollQuestion()
    {
        return $this->belongsTo(PollQuestion::class, 'question_id', 'id');
    }

    public function pollAnswer()
    {
        return $this->belongsTo(PollAnswer::class, 'answer_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
