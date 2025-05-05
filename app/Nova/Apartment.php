<?php

namespace App\Nova;

use App\Nova\Filters\BlockFilter;
use App\Nova\Filters\BuildingFilter;
use App\Nova\Filters\CompanyFilter;
use App\Nova\Filters\ComplexFilter;
use App\Nova\Filters\HasExtractFilter;
use App\Nova\Filters\OwnerFilter;
use App\Nova\Filters\RentedFilter;
use Illuminate\Validation\Rule;
use Laravel\Nova\Fields\FormData;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Titasgailius\SearchRelations\SearchesRelations;

class Apartment extends Resource
{
    use SearchesRelations;

    public static $model = \App\Models\Apartment::class;

    public static function label()
    {
        return 'Mənzillər';
    }

    public static function singularLabel()
    {
        return 'Mənzil';
    }

    public static $search = [
        'id', 'apartment_number',
    ];

    public static $title='apartment_number';
    public static $searchRelations = [
        'company' => ['name'],
        'owner' =>['full_name'],
        'complex'=>['name'],
        'building'=>['name']
    ];

    // // Ancaq admin əlavə edə bilər
    // public static function authorizedToCreate(NovaRequest $request)
    // {
    //     return $request->user()->isAdmin();
    // }

    // Apartment.php resurs faylında
   public static function relatableTenant(NovaRequest $request, $query)
   {
       if ($request->input('is_rented') && $companyId = $request->input('company_id')) {
           return $query->where('company_id', $companyId);
       }
       return $query;
   }


    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Şirkət', 'company', Company::class)
                ->sortable()
                ->rules('required'),

            BelongsTo::make('Mülkiyyətçi', 'owner', Owner::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('company', function (BelongsTo $field, NovaRequest $request, $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $query->where('company_id', $formData->company);
                    });
                })->searchable(),
            BelongsTo::make('Kompleks', 'complex', Complex::class)
                ->dependsOn('company', function (BelongsTo $field, NovaRequest $request, FormData $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $query->where('company_id', $formData->company);
                    });
                }),

            BelongsTo::make('Bina', 'building', Building::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('complex', function (BelongsTo $field, NovaRequest $request, $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $query->where('complex_id', $formData->complex);
                    });
                }),

            BelongsTo::make('Blok', 'block', Block::class)
                ->sortable()
                ->rules('required')
                ->dependsOn('building', function (BelongsTo $field, NovaRequest $request, $formData) {
                    $field->relatableQueryUsing(function (NovaRequest $request, Builder $query) use ($formData) {
                        $query->where('building_id', $formData->building);
                    });
                }),

            Text::make('Mənzil Nömrəsi', 'apartment_number')
                ->sortable()
                ->rules([
                    'required',
                    'min:1',
                    Rule::unique('apartments')->where(function ($query) use ($request) {
                        return $query->where('building_id', $request->input('building') ?? $this->building_id);
                    }),
                ])
                ->creationRules([
                    Rule::unique('apartments')->where(function ($query) use ($request) {
                        return $query->where('building_id', $request->input('building') ?? $this->building_id);
                    }),
                ])
                ->updateRules([
                    Rule::unique('apartments')->where(function ($query) use ($request) {
                        return $query->where('building_id', $request->input('building') ?? $this->building_id);
                    })->ignore($this->id), // Ignore the current record when updating
                ])
                ->resolveUsing(function ($value, $resource) {
                    return $value; // Ensures the value is correctly resolved in Nova
                }),

            Number::make('Otaq Sayı', 'room_count')
                ->sortable()
                ->rules('required', 'integer', 'min:1'),

            Number::make('Mənzilin Ümumi Ölçüsü (m²)', 'total_area')
                ->sortable()
                ->rules('required', 'numeric', 'min:1'),

            Number::make('Mənzilin Yaşayış Sahəsi (m²)', 'living_area')
                ->sortable()
                ->rules('required', 'numeric', 'min:1'),

            Boolean::make('Çıxarış var', 'has_extract')
                ->sortable(),

            Text::make('Qeydiyyat nömrəsi', 'registration_number')
                ->sortable()
                ->rules(function (NovaRequest $request) {
                    return $request->input('has_extract') ? ['required', 'string', 'max:255'] : ['nullable', 'string', 'max:255'];
                })
                ->dependsOn(['has_extract'], function ($field, NovaRequest $request, $formData) {
                    if (!empty($formData['has_extract'])) {
                        $field->show();
                    } else {
                        $field->hide();
                    }
                }),

            Text::make('Reyestr nömrəsi', 'registry_number')
                ->sortable()
                ->rules(function (NovaRequest $request) {
                    return $request->input('has_extract') ? ['required', 'string', 'max:255'] : ['nullable', 'string', 'max:255'];
                })
                ->dependsOn(['has_extract'], function ($field, NovaRequest $request, $formData) {
                    if (!empty($formData['has_extract'])) {
                        $field->show();
                    } else {
                        $field->hide();
                    }
                }),
            Date::make('Verilmə tarixi', 'issued_date')
                ->sortable()
                ->rules(function (NovaRequest $request) {
                    return $request->input('has_extract') ? ['required', 'string', 'max:255'] : ['nullable', 'string', 'max:255'];
                })
                ->dependsOn(['has_extract'], function ($field, NovaRequest $request, $formData) {
                    if (!empty($formData['has_extract'])) {
                        $field->show();
                    } else {
                        $field->hide();
                    }
                }),
            Text::make('Mülkiyyətçinin Telefonu', function () {
                return   implode(', ', collect($this->owner?->contact_numbers)->map(function ($item) {
                    return $item['fields']['phone'] ?? null;
                })->filter()->toArray());
            })
                ->readonly()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            Text::make('Mülkiyyətçinin Q.Ünvanı', function () {
                return $this->owner?->registration_address;
            })
                ->readonly()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
            BelongsToMany::make('Kirayəçilər', 'tenants', Tenant::class)
            ->fields(function () {
                return [
                    Boolean::make('Status', 'status')
                        ->trueValue(1)
                        ->falseValue(0)
                        ->sortable(),
                ];
            })

        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new CompanyFilter(),
            new ComplexFilter(),
            new BuildingFilter(),
            new BlockFilter(),
            new OwnerFilter(),
            new RentedFilter(),
            // new HasExtractFilter(),
        ];
    }
    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
