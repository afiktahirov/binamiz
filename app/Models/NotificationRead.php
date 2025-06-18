<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\NotificationReadObserver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(NotificationReadObserver::class)]
class NotificationRead extends Model
{

    protected $fillable = ['notification_id', 'user_id', 'read_at'];

    protected $casts = [
        'read_at' => 'datetime',
    ];

    public function notification()
    {
        return $this->belongsTo(NotificationModel::class, 'notification_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
