<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Observers\NotificationModelObserver;
use Database\Factories\NotificationModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;

#[ObservedBy(NotificationModelObserver::class)]
class NotificationModel extends Model
{
    use HasFactory;

    protected $table = 'notifications';

    protected $fillable = [
        'title',
        'content',
        'type',
        'target_user_type',
    ];
    
    public function reads()
    {
        return $this->hasMany(NotificationRead::class, 'notification_id');
    }

    public function isReadByUser($userId)
    {
        return $this->reads()->where('user_id', $userId)->exists();
    }
}
