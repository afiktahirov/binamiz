<?php

namespace App\Exports;

use App\Models\Garage;
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
            'owner:id,full_name,id_series,id_number,contact_numbers',
            'building:id,name',
        ])->whereIn('id', $this->garages)->get();
    }

    public function headings(): array
    {
        return [
            "Adı soyadı ata adı", "Seriya", "Vəsiqə nömrəsi",
            "Garaj Nömrəsi", "registration_number","registry_number",
            "Contact Number"
        ];
    }

    public function map($garage): array
    {
        return [
            $garage->owner?->full_name,
            $garage->owner?->id_series,
            $garage->owner?->id_number,
            $garage->garage_number,
            $garage->registration_number,
            $garage->registry_number,
            implode(', ', collect($garage->owner?->contact_numbers)->map(function ($item) {
                return $item['fields']['phone'] ?? null;
            })->filter()->toArray()),
        ];
    }
}
