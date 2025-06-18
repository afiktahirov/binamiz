<?php

namespace App\Models;

use App\Enums\ApplicationDepartmentEnum;
use App\Enums\ApplicationStatusEnum;
use App\Enums\ApplicationTypeEnum;
use App\Policies\ApplicationPolicy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Application extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    public $mediaPath = 'applications/';
    
    protected $fillable = [
        'user_id',
        'type',
        'department',
        'status',
        'assigned_user_id',
        'title',
        'content',
    ];
    
    protected $casts = [
        'type' => ApplicationTypeEnum::class,
        'department' => ApplicationDepartmentEnum::class,
        'status' => ApplicationStatusEnum::class
    ];

    protected static function booted()
    {
        static::updating(function ($model) {
            $model->assigned_user_id = $model->assigned_user_id ?? auth()->id();
        });
    }


    public function user() 
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function assignedUser() 
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function comments() 
    {
        return $this->hasMany(ApplicationComment::class, 'application_id');
    }
}
