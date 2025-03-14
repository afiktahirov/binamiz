<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['owner_id', 'debt_id', 'amount', 'type'];

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function debt()
    {
        return $this->belongsTo(Debt::class);
    }
}
