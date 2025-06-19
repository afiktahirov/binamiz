<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id','balance', 'full_name', 'citizenship', 'contact_numbers',
        'id_series', 'id_number', 'new_id_card', 'birth_date', 'registration_address',
        'issue_date', 'issuing_authority', 'valid_until'
    ];

    protected $casts = [
        'contact_numbers' => 'array', // Əlaqə nömrələrini JSON kimi saxlayır
        'birth_date' => 'date',
        'issue_date' => 'date',
        'valid_until' => 'date',
    ];

    protected function finCode(): Attribute
    {
        return Attribute::make(
            set: fn (string $value) => mb_strtoupper($value),
        );
    }

    public function user()
    {
        return $this->hasOne(User::class, 'owner_or_tenant_id')->where('role', 'tenant');
    }

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

    public function objects()
    {
        return $this->hasMany(Obyekt::class,'tenant_id');
    }

    public function vehicles()
    {
        return $this->hasManyThrough(Vehicle::class, Apartment::class, 'tenant_id', 'apartment_id', 'id', 'id');
    }
}
