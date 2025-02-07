<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flat extends Model
{
    use HasFactory;

    public function flats()
    {
        return $this->hasMany(Flat::class,'block_id');
    }

    public function residences()
    {
        return $this->hasMany(Residence::class,'block_id');
    }

    public function apartment()
    {
        return $this->belongsTo(Apartment::class,'apartment_id');
    }
}
