<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthSession extends Model
{
    protected $table = "sessions"; 
    
    protected $casts = [
        'id' => 'string'
    ];
}
