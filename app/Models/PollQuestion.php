<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollQuestion extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'question',
    ];

    public function poll()
    {
        return $this->belongsTo(Poll::class);
    }
    
    public function answers()
    {
        return $this->hasMany(PollAnswer::class, 'question_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class, 'question_id', 'id');
    }
}
