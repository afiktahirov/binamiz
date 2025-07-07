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

    // Mənzillər ilə əlaqə
    public function apartments()
    {
        return $this->hasMany(Apartment::class);
    }

    // Obyektlər ilə əlaqə
    public function objects()
    {
        return $this->hasMany(Obyekt::class);
    }

    // Qarajlar ilə əlaqə
    public function garages()
    {
        return $this->hasMany(Garage::class);
    }

    // Bloklar ilə əlaqə
    public function blocks()
    {
        return $this->hasMany(Block::class);
    }
    
    // Komunal ilə əlaqə
    public function comunals()
    {
        return $this->hasMany(Comunal::class);
    }

    // Nəqliyyat vasitələri ilə əlaqə
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
