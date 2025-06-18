<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PollAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'answer',
    ];

    public function question()
    {
        return $this->belongsTo(PollQuestion::class, 'question_id', 'id');
    }

    public function votes()
    {
        return $this->hasMany(PollVote::class, 'answer_id', 'id');
    }

}
