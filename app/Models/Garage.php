<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Garage extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'complex_id', 'building_id', 'garage_number',
        'size', 'status', 'renter_type', 'renter_id','has_extract','issue_date'
    ];

    protected $casts = [
        'status' => 'string',
        'renter_type' => 'string',
        'has_extract' => 'boolean',
        'issue_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($garage) { // `creating` və `updating` üçün işləyəcək
            if (self::where('company_id', $garage->company_id)
                ->where('complex_id', $garage->complex_id)
                ->where('building_id', $garage->building_id)
                ->where('garage_number', $garage->garage_number)
                ->where('id', '!=', $garage->id) // Öz ID-sini yoxlamasın
                ->exists()) {
                throw new \Exception("Bu qaraj nömrəsi artıq eyni binada mövcuddur.");
            }
        });
    }

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

    public function owner()
    {
        return $this->belongsTo(Owner::class, 'renter_id')->whereNotNull('renter_id');
    }

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'renter_id')->whereNotNull('renter_id');
    }

    public function availableVehicles()
    {
        return $this->hasMany(Vehicle::class, 'garage_id');
    }

    public function scopeHasAvailableSpace($query)
    {
        return $query->whereRaw('place_count > (SELECT COUNT(*) FROM vehicles WHERE vehicles.garage_id = garages.id)');
    }

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class, 'garage_tenant')->withTimestamps();
    }

}
