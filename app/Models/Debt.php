<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Debt extends Model
{
    protected $fillable = [
        'comunal_id',
        'calculated_amount',
        'discount_amount',
        'discount_percent',
        'total_amount',
    ];

    public function comunal()
    {
        return $this->belongsTo(Comunal::class,'comunal_id');
    }
    
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
