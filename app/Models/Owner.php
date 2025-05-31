<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'full_name', 'citizenship', 'contact_numbers',
        'id_series', 'id_number', 'birth_date', 'registration_address',
        'issue_date', 'issuing_authority', 'valid_until'
    ];

    protected $casts = [
        'contact_numbers' => 'array',
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
        return $this->hasOne(User::class, 'owner_or_tenant_id');
    }

    // Şirkət ilə əlaqə
    public function company()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function aparments()
    {
        return $this->hasMany(Apartment::class,'owner_id');
    }

    public function garages()
    {
        return $this->hasMany(Garage::class,'owner_id');
    }

    public function obyekts()
    {
        return $this->hasMany(Obyekt::class,'owner_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function comunals()
    {
        return $this->hasMany(Comunal::class);
    }

    public function debts()
    {
        return $this->hasManyThrough(
            Debt::class,      // Final model
            Comunal::class,   // Intermediate model
            'apartment_id',   // Foreign key on `comunals` table
            'comunal_id',     // Foreign key on `debts` table
            'id',             // Local key on `owners` table
            'id'              // Local key on `apartments` table
        );
    }
}
