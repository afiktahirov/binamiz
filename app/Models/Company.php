<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $casts = [
        'registration_date' => 'date', // Qeydiyyat tarixi
        'license_date' => 'date', // Lisenziya tarixi
    ];

    protected $fillable = ['name','logo', 'legal_name', 'legal_address', 'taxpayer_id', 'registration_number', 'registration_date', 'legal_form', 'bank_name', 'bank_branch', 'iban', 'swift_code', 'correspondent_account', 'phone', 'email', 'website', 'executive_person', 'license_number', 'license_date'];

    
    public function complex()
    {
        
    }


}
