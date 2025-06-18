<?php

namespace App\Exports;

use App\Models\Garage;
use Laravel\Nova\Actions\ActionModelCollection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GaragesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $garages;

    public function __construct($garages)
    {
        $this->garages = $garages;
    }

    public function collection()
    {
        return Garage::with([
            'company:id,name',
            'complex:id,name',
            'owner:id,full_name,id_series,id_number,contact_numbers',
            'building:id,name',
        ])->whereIn('id', $this->garages)->get();
    }

    public function headings(): array
    {
        return [
            "Şirkət", "Kompleks", "Bina",
            "Qaraj Nömrəsi", "Ölçüsü (m²)", "Yer sayı", "Statusu", "Çıxarış var",
            "Registration Number","Registry Number",
            "Adı soyadı ata adı", "Seriya", "Vəsiqə nömrəsi",
            "Contact Number"
        ];
    }

    public function map($garage): array
    {
        return [
            $garage->company?->name,
            $garage->complex?->name,
            $garage->building?->name,
            $garage->garage_number,
            $garage->size,
            $garage->place_count,
            $garage->status,
            $garage->has_extract ? 'Bəli' : 'Xeyr',
            $garage->registration_number,
            $garage->registry_number,
            $garage->owner?->full_name,
            $garage->owner?->id_series,
            $garage->owner?->id_number,
            implode(', ', collect($garage->owner?->contact_numbers)->map(function ($item) {
                return $item['fields']['phone'] ?? null;
            })->filter()->toArray()),
        ];
    }
}
