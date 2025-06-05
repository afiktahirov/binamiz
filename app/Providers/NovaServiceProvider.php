<?php

namespace App\Providers;

use App\Nova\AccountingAccount;
use App\Nova\AccountingSubAccount;
use App\Nova\Apartment;
use App\Nova\Block;
use App\Nova\Building;
use App\Nova\Company;
use App\Nova\Complex;
use App\Nova\FinancialItem;
use App\Nova\FinancialSection;
use App\Nova\Flat;
use App\Nova\Garage;
use App\Nova\Interaccounting;
use App\Nova\Obyekt;
use App\Nova\Owner;
use App\Nova\Receipt;
use App\Nova\Repeater\RegistrationNumbers;
use App\Nova\Residence;
use App\Nova\Service;
use App\Nova\VehicleBrand;
use App\Nova\VehicleColor;
use App\Nova\VehicleType;
use App\Nova\Tenant;
use App\Nova\RegionNumber;
use App\Nova\Vehicle;
use App\Nova\ServiceType;
use App\Nova\Comunal;
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
                /** ------------------ İDARƏETMƏ (Management) ------------------ **/
                MenuSection::make(__('İdarəetmə'), [
                    MenuItem::resource(Company::class)->name("Şirkətlər"),
                    MenuItem::resource(Complex::class)->name("Komplekslər"),
                    MenuItem::resource(Building::class)->name("Binalar"),
                    MenuItem::resource(Block::class)->name("Bloklar"),
                    MenuItem::resource(Apartment::class)->name("Mənzillər"),
                    MenuItem::resource(Garage::class)->name("Qarajlar"),
                    MenuItem::resource(Obyekt::class)->name("Obyektlər"),
                ])->icon('home')->collapsable(),

                /** ------------------ SAKİNLƏR (Residents) ------------------ **/
                MenuSection::make(__('Sakinlər'), [
                    MenuItem::resource(Owner::class)->name("Mülkiyyətçilər"),
                    MenuItem::resource(Tenant::class)->name("Kirayəçilər"),
                ])->icon('users')->collapsable(),

                /** ------------------ MALİYYƏ (Finance) ------------------ **/
                MenuSection::make(__('Maliyyə'), [
                    MenuItem::resource(AccountingAccount::class)->name("Hesablar"),
                    MenuItem::resource(AccountingSubAccount::class)->name("Sub Hesablar"),
                    MenuItem::resource(Interaccounting::class)->name("Müxabirləşmə"),
                    MenuItem::resource(FinancialSection::class)->name("Maliyyə Bölmələri"),
                    MenuItem::resource(FinancialItem::class)->name("Maliyyə Maddələri"),
                ])->icon('credit-card')->collapsable(),

                /** ------------------ AVTOMOBİL (Vehicles) ------------------ **/
                MenuSection::make(__('Avtomobil'), [
                    MenuItem::resource(Vehicle::class)->name("Avtomobillər"),
                    MenuItem::resource(VehicleBrand::class)->name("Avtomobil Markası"),
                    MenuItem::resource(VehicleColor::class)->name("Avtomobil Rəngi"),
                    MenuItem::resource(VehicleType::class)->name("Avtomobil Növü"),
                    MenuItem::resource(RegionNumber::class)->name("Region nömrələri"),
                ])->icon('truck')->collapsable(),

                /** ------------------ DİGƏR XİDMƏTLƏR (Other Services) ------------------ **/
                MenuSection::make(__('Digər xidmətlər'), [
                    MenuItem::resource(Service::class)->name("Əlavə Xidmətlər"),
                    MenuItem::resource(Comunal::class)->name("Komunallar"),
                    MenuItem::resource(ServiceType::class)->name("Xidmət növləri"),
                ])->icon('briefcase')->collapsable(),

                /** ------------------ TƏNZİMLƏMƏLƏR (Settings) ------------------ **/
                MenuSection::make(__('Tənzimləmələr'))
                    ->path('nova-settings')
                    ->icon('adjustments'),
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
            // return in_array($user->email, [
            //     //
            // ]);
            return $user->role === 'admin' || $user->role === 'manager';
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
