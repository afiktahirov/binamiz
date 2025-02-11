<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'owner_id', 'complex_id', 'building_id', 'block_id',
        'apartment_number', 'room_count', 'total_area', 'living_area',
        'is_rented', 'tenant_id'
    ];

    protected $casts = [
        'is_rented' => 'boolean',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
}
