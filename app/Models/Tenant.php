<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'full_name', 'citizenship', 'contact_numbers',
        'id_series', 'id_number', 'birth_date', 'registration_address',
        'issue_date', 'issuing_authority', 'valid_until'
    ];

    protected $casts = [
        'contact_numbers' => 'array', // Əlaqə nömrələrini JSON kimi saxlayır
        'birth_date' => 'date',
        'issue_date' => 'date',
        'valid_until' => 'date',
    ];

    // Şirkət ilə əlaqə
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function apartments()
    {
        return $this->belongsToMany(Apartment::class, 'apartment_tenant')->withTimestamps();
    }

    public function garages()
    {
        return $this->hasMany(Garage::class,'tenant_id');
    }

    public function obyekts()
    {
        return $this->hasMany(Obyekt::class,'tenant_id');
    }
}
