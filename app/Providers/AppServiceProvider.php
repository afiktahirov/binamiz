<?php

namespace App\Providers;

use App\Models\Owner;
use App\Observers\OwnerObserver;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Nova\Observable;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Relation::morphMap([
            'owners'  => \App\Models\Owner::class,
            'tenants' => \App\Models\Tenant::class,
        ]);
    }
}
