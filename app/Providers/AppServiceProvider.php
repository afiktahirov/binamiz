<?php

namespace App\Providers;

use App\Models\Owner;
use Laravel\Nova\Observable;
use App\Observers\OwnerObserver;
use App\Services\NotificationService;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;

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
        
        Route::pattern('id', '[0-9]+');

        View::composer('*', function ($view) {
            if (auth()->check())
                $view->with('top_notifications', (new NotificationService)->getUserNotifications());
        });
    }
}
