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
        'issued_date' => 'date',
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

    public function tenants()
    {
        return $this->belongsToMany(Tenant::class, 'apartment_tenant')->withTimestamps();
    }

    public static function boot()
    {
        parent::boot();

        static::saving(function ($apartment) {
            if (self::where('building_id', $apartment->building_id)
                ->where('apartment_number', $apartment->apartment_number)
                ->where('id', '!=', $apartment->id)
                ->exists()) {
                throw new \Exception("Bu mənzil nömrəsi artıq eyni şirkətin, kompleks və blokunda mövcuddur.");
            }
        });

        // static::saving(function ($apartment) {
        //     if ($apartment->owner_id && self::where('id', $apartment->id)->whereNotNull('owner_id')->exists()) {
        //         throw new \Exception("Bu mənzil artıq mülkiyyətçiyə məxsusdur. Yalnız mülkiyyətçi dəyişdirilə bilər.");
        //     }
        // });
    }


}
