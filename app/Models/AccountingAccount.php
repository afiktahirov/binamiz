<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountingAccount extends Model
{
    use HasFactory;

    protected $table ='accounting_accounts';

    public function parentAccount()
    {
        return $this->belongsTo(self::class, 'parent_account');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function complex()
    {
        return $this->belongsTo(Complex::class);
    }

    public function building()
    {
        return $this->belongsTo(Building::class);
    }


}
