<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'vehicle_id', 'user_id', 'comment', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
    
}
