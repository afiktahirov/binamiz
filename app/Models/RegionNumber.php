<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegionNumber extends Model
{
    use HasFactory;

    protected $fillable = ['region_number', 'region_name'];

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class, 'region_id');
    }
}
