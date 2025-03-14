<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Interaccounting extends Model
{
    public function debetAccount()
    {
        return $this->belongsTo(AccountingAccount::class, 'debet_account');
    }

    public function creditAccount()
    {
        return $this->belongsTo(AccountingAccount::class, 'credit_account');
    }
}
