<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Outl1ne\NovaSettings\Models\Settings;

class NovaSettings extends Settings
{
    use HasFactory;
    
    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            Cache::forget('nova_settings_favicon');
        });
    }
}
