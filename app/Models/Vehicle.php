<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;

    protected $fillable = [
        'blacklist', 'comment', 'building_id', 'apartment_id',
        'region_number', 'first_letter', 'second_letter',
        'plate_number', 'contact_numbers', 'status', 'active'
    ];

    protected $casts = [
        'blacklist' => 'boolean',
        'contact_numbers' => 'array', // Telefon nömrələri JSON kimi saxlanacaq
        'active' => 'boolean',
    ];

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function garageBuilding()
    {
        return $this->belongsTo(Building::class,'garage_building_id');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class, 'complex_id');
    }

    public function garage()
    {
        return $this->belongsTo(Garage::class, 'garage_id');
    }

    public function object()
    {
        return $this->belongsTo(Obyekt::class, 'object_id');
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type_id');
    }

    public function color()
    {
        return $this->belongsTo(VehicleColor::class, 'color_id');
    }

    public function brand()
    {
        return $this->belongsTo(VehicleBrand::class, 'brand_id');
    }


    public static function boot()
    {
        parent::boot();

        static::saving(function ($vehicle) {
            if (!$vehicle->company_id || !$vehicle->complex_id) {
                throw new \Exception("Avtomobil əlavə edərkən şirkət və kompleks seçilməlidir.");
            }
        });
    }

    public function region()
    {
        return $this->belongsTo(RegionNumber::class, 'region_id');
    }



}
