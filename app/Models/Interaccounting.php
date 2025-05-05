<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\NumberToWords;

class Interaccounting extends Model
{

    protected static function booted()
    {
        static::saving(function ($model) {
            if ($model->amount) {
                $model->amount_with_letter = NumberToWords::convert($model->amount);
            }
        });
    }

    public function debetAccount()
    {
        return $this->belongsTo(AccountingAccount::class, 'debet_account');
    }

    public function creditAccount()
    {
        return $this->belongsTo(AccountingAccount::class, 'credit_account');
    }
}
