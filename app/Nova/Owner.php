<?php
namespace App\Nova;

use App\Nova\Filters\CitizenshipFilter;
use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\OwnerNameFilter;
use App\Nova\Repeater\ContactNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Email;
use Laravel\Nova\Fields\HasMany;
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
                Text::make('Seriya', 'id_series'),
                Text::make('Vəsiqə Nömrəsi', 'id_number')->rules('required'),
                Text::make('Fin Kod', 'fin_code')->sortable()
                    ->rules('required', 'size:7'),
                Date::make('Doğum Tarixi', 'birth_date')->nullable(),
                Text::make('Qeydiyyat Ünvanı', 'registration_address')->nullable(),
                Date::make('Verilmə Tarixi', 'issue_date')->nullable(),
                Text::make('Verən Orqan', 'issuing_authority')->nullable(),
                Date::make('Etibarlılıq Müddəti', 'valid_until')->nullable(),

            ]),
            new \Laravel\Nova\Panel('Balans',[
                Number::make('Balance', 'balance')
                    ->hideWhenCreating()
                    ->hideWhenUpdating()
                    ->sortable()
                    ->step(0.01)
                    ->rules('required')
            ]),

            HasMany::make('Mənzillər', 'apartments', Apartment::class),
            HasMany::make('Qarajlar', 'garages', Garage::class),
            HasMany::make('Obyektlər', 'objects', Obyekt::class),
            HasMany::make('Debts', 'debts', Debt::class),
        ];
    }

    public static function afterCreate(NovaRequest $request, $model)
    {
        DB::transaction(function () use ($request, $model) {
            \App\Models\User::create([
                'company_id' => $model->company_id,
                'name' => explode(' ', $model->full_name)[0],
                'full_name' => $model->full_name,
                'citizenship' => $model->citizenship,
                'fin_code' => mb_strtoupper($model->fin_code),
                'id_series' => $model->id_series,
                'id_number' => $model->id_number,
                'birth_date' => $model->birth_date,
                'contact_numbers' => $model->contact_numbers,
                'registration_address' => $model->registration_address,
                'issuing_authority' => $model->issuing_authority,
                'issue_date' => $model->issue_date,
                'valid_until' => $model->valid_until,
                'owner_or_tenant_id' => $model->id,
                'role' => 'owner',
                'password' => mb_strtoupper($model->fin_code),
            ]);

        });
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
