<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    public function blocks()
    {
        return $this->hasMany(Block::class,'apartment_id');
    }

    public function flats()
    {
        return $this->hasMany(Flat::class,'apartment_id');
    }

    public function residences()
    {
        return $this->hasMany(Residence::class,'apartment_id');
    }
}
