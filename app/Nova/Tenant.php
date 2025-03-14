<?php

namespace App\Nova;

use App\Nova\Repeater\ContactNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Titasgailius\SearchRelations\SearchesRelations;

class Tenant extends Resource
{
    use SearchesRelations;
    public static $model = \App\Models\Tenant::class;

    public static function label()
    {
        return 'Kirayəçilər';
    }

    public static function singularLabel()
    {
        return 'Kirayəçi';
    }

    public static $title = 'full_name';

    public static $search = [
        'id', 'full_name',
    ];
    public static $searchRelations = [
        'company' => ['name'],
    ];
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

            // Yeni Repeater ilə Əlaqə Nömrələri
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

                BelongsToMany::make('Mənzillər', 'apartments', Apartment::class)
                    ->fields(function () {
                    return [
                        Boolean::make('Status', 'status')
                            ->trueValue(1)
                            ->falseValue(0)
                            ->sortable(),
                    ];
                }),
                HasMany::make('Qarajlar', 'garages', Garage::class),
                HasMany::make('Obyektlər', 'obyekts', Obyekt::class),
            ]),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
