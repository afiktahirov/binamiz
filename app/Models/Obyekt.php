<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obyekt extends Model
{
    protected $table = 'objects';
    protected $casts = [
        'status' => 'string',
        'renter_type' => 'string',
        'has_extract' => 'boolean',
        'issue_date' => 'date',
    ];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($object) { // `creating` və `updating` üçün işləyəcək
            if (self::where('company_id', $object->company_id)
                ->where('complex_id', $object->complex_id)
                ->where('building_id', $object->building_id)
                ->where('object_number', $object->object_number)
                ->where('id', '!=', $object->id) // Öz ID-sini yoxlamasın
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
        return $this->hasMany(Vehicle::class, 'object_id');
    }
}
