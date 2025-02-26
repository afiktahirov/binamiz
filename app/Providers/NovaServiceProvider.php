<?php

namespace App\Providers;

use App\Nova\Apartment;
use App\Nova\Block;
use App\Nova\Building;
use App\Nova\Company;
use App\Nova\Complex;
use App\Nova\Flat;
use App\Nova\Garage;
use App\Nova\Obyekt;
use App\Nova\Owner;
use App\Nova\Receipt;
use App\Nova\Repeater\RegistrationNumbers;
use App\Nova\Residence;
use App\Nova\Service;
use App\Nova\Tenant;
use App\Nova\RegionNumber;
use App\Nova\Vehicle;
use App\Nova\ServiceType;
use Illuminate\Support\Facades\Gate;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Repeater\Presets\JSON;
use Laravel\Nova\Fields\Text;
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

        \Outl1ne\NovaSettings\NovaSettings::addSettingsFields([
            Text::make('Some setting', 'some_setting'),
            Number::make('A number', 'a_number'),
        ]);

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
                    MenuItem::resource(resourceClass: Obyekt::class)->name("Obyektlər"),
                    MenuItem::resource(resourceClass: Vehicle::class)->name("Avtomobillər"),
                    MenuItem::resource(resourceClass: Service::class)->name("Əlavə Xidmətlər"),
                    MenuItem::resource(resourceClass: ServiceType::class)->name("Xidmət növləri"),
                    MenuItem::resource(resourceClass: RegionNumber::class)->name("Region nömrələri"),
                    MenuSection::make(__('Tənzimləmələr'))
                    ->path('nova-settings')
                    ->icon('adjustments'),
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
        return [
            new \Outl1ne\NovaSettings\NovaSettings
        ];
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
