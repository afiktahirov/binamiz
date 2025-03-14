<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialSection extends Model
{
    use HasFactory;

    public function financialItems()
    {
        return $this->hasMany(FinancialItem::class, 'financial_section_id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }
}
