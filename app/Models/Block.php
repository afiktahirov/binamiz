<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id', 'complex_id', 'building_id', 'block_number',
        'lift_count', 'total_flats', 'max_flats_per_block'
    ];

    // Şirkət ilə əlaqə
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

    public static function boot()
    {
        parent::boot();

        static::saving(function ($block) {
            if (self::where('company_id', $block->company_id)
                ->where('complex_id', $block->complex_id)
                ->where('block_number', $block->block_number)
                ->where('id', '!=', $block->id) 
                ->exists()) {
                throw new \Exception("Bu blok nömrəsi artıq eyni şirkətin eyni kompleksində mövcuddur.");
            }
        });
    }

}
