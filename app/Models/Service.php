<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_type', 'name', 'provider', 'contact_number', 'rating'
    ];

    protected $casts = [
        'rating' => 'decimal:1',
    ];
}
