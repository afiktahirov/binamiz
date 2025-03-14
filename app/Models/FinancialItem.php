<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialItem extends Model
{
    public function financialSection()
    {
        return $this->belongsTo(FinancialSection::class, 'financial_section_id');
    }
}
