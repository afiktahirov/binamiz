<?php

namespace App\Providers;

use App\Nova\Flat;
use App\Nova\Poll;
use App\Nova\Block;
use App\Nova\Owner;
use App\Nova\Garage;
use App\Nova\Obyekt;
use App\Nova\Tenant;
use App\Nova\Company;
use App\Nova\Complex;
use App\Nova\Comunal;
use App\Nova\Receipt;
use App\Nova\Service;
use App\Nova\Vehicle;
use App\Nova\Building;
use App\Nova\PollVote;
use Laravel\Nova\Nova;
use App\Nova\Apartment;
use App\Nova\Residence;
use App\Nova\Application;
use App\Nova\ServiceType;
use App\Nova\VehicleType;
use App\Nova\Notification;
use App\Nova\RegionNumber;
use App\Nova\VehicleBrand;
use App\Nova\VehicleColor;
use App\Nova\FinancialItem;
use App\Nova\Interaccounting;
use Laravel\Nova\Fields\Text;
use App\Nova\FinancialSection;
use App\Nova\AccountingAccount;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Menu\MenuItem;
use Laravel\Nova\Fields\Repeater;
use App\Nova\AccountingSubAccount;
use Laravel\Nova\Menu\MenuSection;
use Illuminate\Support\Facades\Gate;
use App\Nova\Repeater\RegistrationNumbers;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Repeater\Presets\JSON;
use Laravel\Nova\NovaApplicationServiceProvider;
use Outl1ne\NovaSettings\NovaSettings;

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
            Image::make('Favicon','favicon')
                ->path('uploads/nova-settings')
                ->acceptedTypes(['image/png'])
                ->rules('mimes:png')
                ->storeAs(function (){
                    return 'favicon.png';
                }),
            Text::make('Nova Login Page Title','nova_login_page_title'),
            Image::make('Login Page Image','nova_login_bg_image')
                ->path('uploads/nova-settings'),
        ]);
        

        Nova::mainMenu(function () {
            return [
                /** ------------------ ƏMLAK İDARƏETMƏSİ (Property Management) ------------------ **/
                MenuSection::make(__('Əmlak İdarəetməsi'), [
                    MenuItem::resource(Company::class)->name("Şirkətlər"),
                    MenuItem::resource(Complex::class)->name("Komplekslər"),
                    MenuItem::resource(Building::class)->name("Binalar"),
                    MenuItem::resource(Block::class)->name("Bloklar"),
                    MenuItem::resource(Apartment::class)->name("Mənzillər"),
                    MenuItem::resource(Garage::class)->name("Qarajlar"),
                    MenuItem::resource(Obyekt::class)->name("Obyektləri"),
                ])->icon('home')->collapsable(),

                /** ------------------ AVTOMOBİL İDARƏETMƏSİ (Vehicle Management) ------------------ **/
                MenuSection::make(__('Avtomobil İdarəetməsi'), [
                    MenuItem::resource(Vehicle::class)->name("Avtomobillər"),
                    MenuItem::resource(VehicleBrand::class)->name("Avtomobil Markaları"),
                    MenuItem::resource(VehicleColor::class)->name("Avtomobil Rəngləri"),
                    MenuItem::resource(VehicleType::class)->name("Avtomobil Növləri"),
                    MenuItem::resource(RegionNumber::class)->name("Region nömrələri"),
                ])->icon('truck')->collapsable(),

                /** ------------------ MÜLKİYYƏT VƏ İSTİFADƏÇİLƏR (Ownership and Users) ------------------ **/
                MenuSection::make(__('Mülkiyyət və İstifadəçilər'), [
                    MenuItem::resource(Owner::class)->name("Mülkiyyətçilər"),
                    MenuItem::resource(Tenant::class)->name("Kirayəçilər"),
                ])->icon('users')->collapsable(),

                /** ------------------ XİDMƏTLƏR VƏ ÖDƏNİŞLƏR (Services and Payments) ------------------ **/
                MenuSection::make(__('Xidmətlər və Ödənişlər'), [
                    MenuItem::resource(Service::class)->name("Əlavə Xidmətlər"),
                    MenuItem::resource(Comunal::class)->name("Kommunal Xidmətlər"),
                    MenuItem::resource(ServiceType::class)->name("Xidmət Növləri"),
                ])->icon('briefcase')->collapsable(),

                /** ------------------ ƏLAQƏ VƏ İNTERAKTİVLİK (Communication and Interaction) ------------------ **/
                MenuSection::make(__('Əlaqə və İnteraktivlik'), [
                    MenuItem::resource(Notification::class)->name("Bildirişlər"),
                    MenuItem::resource(Application::class)->name("Müraciətlər"),
                    MenuItem::resource(Poll::class)->name("Sorğular (Quizlər)"),
                    MenuItem::resource(PollVote::class)->name("Sorğu Cavabları"),
                ])->icon('chat-alt')->collapsable(),

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
