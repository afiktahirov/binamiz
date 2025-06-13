<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'target_user_type',
        'expires_at',
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(PollQuestion::class, 'poll_id', 'id');
    }

    public function answers()
    {
        return $this->hasManyThrough(PollAnswer::class, PollQuestion::class, 'poll_id', 'question_id', 'id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class, 'poll_id', 'id');
    }
}
