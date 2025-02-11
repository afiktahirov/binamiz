<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'complex_id', 'name', 'block_count', 'garage_count'
    ];

    // Şirkət ilə əlaqə
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Kompleks ilə əlaqə
    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }
}
