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

    public function building()
    {
        return $this->belongsTo(Building::class);
    }

    public function financialItem()
    {
        return $this->belongsTo(FinancialItem::class,'financial_item');
    }

    public function financialSection()
    {
        return $this->belongsTo(FinancialSection::class);
    }

}
