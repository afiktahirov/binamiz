<?php
namespace App\Nova;

use App\Nova\Repeater\ContactNumber;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;

class Owner extends Resource
{
    public static $model = \App\Models\Owner::class;

    public static function label()
    {
        return 'Mülkiyyətçilər';
    }

    public static function singularLabel()
    {
        return 'Mülkiyyətçi';
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Şirkət', 'company', Company::class)
                ->sortable()
                ->rules('required'),

            Text::make('Adı Soyadı Ata Adı', 'full_name')
                ->sortable()
                ->rules('required', 'max:255'),

            Text::make('Vətəndaşlığı', 'citizenship')
                ->sortable()
                ->rules('required', 'max:100'),

            Repeater::make('Əlaqə Nömrələri', 'contact_numbers')
                ->repeatables([
                    ContactNumber::make(),
                ])
                ->rules('required'),

            new \Laravel\Nova\Panel('Şəxsiyyət Vəsiqəsi Məlumatları', [
                Text::make('Seriya', 'id_series')->nullable(),
                Text::make('Vəsiqə Nömrəsi', 'id_number')->nullable(),
                Date::make('Doğum Tarixi', 'birth_date')->nullable(),
                Text::make('Qeydiyyat Ünvanı', 'registration_address')->nullable(),
                Date::make('Verilmə Tarixi', 'issue_date')->nullable(),
                Text::make('Verən Orqan', 'issuing_authority')->nullable(),
                Date::make('Etibarlılıq Müddəti', 'valid_until')->nullable(),
            ]),
        ];
    }
}
