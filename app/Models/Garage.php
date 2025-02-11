<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'complex_id', 'building_id', 'garage_number',
        'size', 'status', 'renter_type', 'renter_id'
    ];

    protected $casts = [
        'status' => 'string',
        'renter_type' => 'string',
    ];

    // Əlaqələr
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function renter()
    {
        return $this->morphTo();
    }
}
