<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Panel;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Resource;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
class Company extends Resource
{
    public static $model = \App\Models\Company::class;

    public static function label()
    {
        return 'Şirkətlər';
    }

    public static function singularLabel()
    {
        return 'Şirkət';
    }
    public static $title = 'name';

    public static $search = [
        'id', 'name','legal_name','bank_name','phone','email'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Şirkətin Adı', 'name')->sortable()->rules('required', 'max:255'),
            Image::make('Logo','logo')
                ->required()
                ->path('uploads/company'),

            new Panel('Hüquqi Məlumatlar', $this->legalInformation()),
            new Panel('Bank Məlumatları', $this->bankInformation()),
            new Panel('Əlaqə Məlumatları', $this->contactInformation()),
            new Panel('İdarəetmə', $this->managementInformation()),
            new Panel('Lisenziyalar və Sertifikatlar', $this->licenseInformation()),
        ];
    }

    protected function legalInformation()
    {
        return [
            Text::make('Şirkətin Tam Adı', 'legal_name')->sortable(),
            Text::make('Hüquqi Ünvan', 'legal_address'),
            Text::make('Vergi Ödəyicisinin Nömrəsi (VÖEN)', 'taxpayer_id')->sortable(),
            Text::make('Qeydiyyat Nömrəsi', 'registration_number'),
            Date::make('Qeydiyyat Tarixi', 'registration_date'),
            Text::make('Hüquqi Forması', 'legal_form'),
        ];
    }

    protected function bankInformation()
    {
        return [
            Text::make('Bank Adı', 'bank_name'),
            Text::make('Bank Filialı', 'bank_branch'),
            Text::make('Hesab Nömrəsi (IBAN)', 'iban'),
            Text::make('SWIFT/BIC Kodu', 'swift_code'),
            Text::make('Korespondent Hesab', 'correspondent_account'),
        ];
    }

    protected function contactInformation()
    {
        return [
            Text::make('Telefon Nömrələri', 'phone'),
            Text::make('E-poçt Ünvanı', 'email'),
            Text::make('Vebsayt', 'website'),
        ];
    }

    protected function managementInformation()
    {
        return [
            Text::make('Direktor və ya İcraçı Şəxs', 'executive_person'),
        ];
    }

    protected function licenseInformation()
    {
        return [
            Text::make('Lisenziya Nömrəsi', 'license_number'),
            Date::make('Lisenziya Tarixi', 'license_date'),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new DownloadExcel,
        ];
    }
}
