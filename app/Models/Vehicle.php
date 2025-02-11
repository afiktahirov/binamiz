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

    public function apartment()
    {
        return $this->belongsTo(Apartment::class);
    }
}
