<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunal extends Model
{
    use HasFactory;

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    // Kompleks ilə əlaqə
    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    // Bina ilə əlaqə
    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }

    public function object()
    {
        return $this->belongsTo(Obyekt::class,'object_id');
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class);
    }

    public function debts()
    {
        return $this->hasMany(Debt::class,'comunal_id');
    }
}
