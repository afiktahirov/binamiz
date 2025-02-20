<?php
namespace App\Nova;

use App\Nova\Filters\CitizenshipFilter;
use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\OwnerNameFilter;
use App\Nova\Repeater\ContactNumber;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\Boolean;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Titasgailius\SearchRelations\SearchesRelations;

class Owner extends Resource
{
    use SearchesRelations;
    public static $model = \App\Models\Owner::class;

    public static function label()
    {
        return 'Mülkiyyətçilər';
    }

    public static function singularLabel()
    {
        return 'Mülkiyyətçi';
    }

    public static $title = 'full_name';

    public static $search = [
        'id', 'full_name','contact_numbers'
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

            Repeater::make('Əlaqə Nömrələri', 'contact_numbers')
                ->repeatables([
                    ContactNumber::make(),
                ])
                ->rules('required'),
            Text::make('Əlaqə Nömrələri', function () {
                if (is_array($this->contact_numbers)) {
                    $numbers = array_map(function ($contact) {
                        return $contact['fields']['phone'] ?? null;
                    }, $this->contact_numbers);

                    return implode(', ', array_filter($numbers));
                }
                return '-';
            })->onlyOnDetail(),

            new \Laravel\Nova\Panel('Şəxsiyyət Vəsiqəsi Məlumatları', [
                Boolean::make('Yeni Vəsiqə', 'new_id_card')
                ->trueValue(1)
                ->falseValue(0)
                ->sortable()
                ->filterable(),
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

    public function filters(NovaRequest $request)
    {
        return [
            new CompanyFilter(),
            new CitizenshipFilter(),
            new OwnerNameFilter(),
        ];
    }
    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
