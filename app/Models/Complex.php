<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Complex extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'name','image', 'address',
        'residential_price', 'non_residential_price', 'garage_price', 'garage_is_fixed'
    ];

    // Şirkət ilə əlaqə
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function buildings()
    {
        return $this->hasMany(Building::class,'building_id');
    }
}
