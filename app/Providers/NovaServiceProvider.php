<?php

namespace App\Providers;

use App\Nova\Apartment;
use App\Nova\Block;
use App\Nova\Building;
use App\Nova\Company;
use App\Nova\Complex;
use App\Nova\Flat;
use App\Nova\Garage;
use App\Nova\Owner;
use App\Nova\Receipt;
use App\Nova\Residence;
use App\Nova\Tenant;
use App\Nova\Vehicle;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;


class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();


        Nova::mainMenu(function () {
            return [
                MenuSection::make(__('İdarəetmə'),[
                    MenuItem::resource(Company::class)->name("Şirkətlər"),
                    MenuItem::resource(Complex::class)->name("Komplekslər"),
                    MenuItem::resource(Building::class)->name("Binalar"),
                    MenuItem::resource(Block::class)->name("Bloklar"),
                    MenuItem::resource(Owner::class)->name("Mülkiyyətçilər"),
                    MenuItem::resource(resourceClass: Tenant::class)->name("Kirayəçilər"),
                    MenuItem::resource(resourceClass: Apartment::class)->name("Mənzillər"),
                    MenuItem::resource(resourceClass: Garage::class)->name("Qarajlar"),
                    MenuItem::resource(resourceClass: Vehicle::class)->name("Avtomobillər"),
                ])
            ];

        });



    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
                ->withAuthenticationRoutes()
                ->withPasswordResetRoutes()
                ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
