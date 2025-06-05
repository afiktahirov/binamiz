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
            $garage->owner->full_name,
            $garage->owner->id_series,
            $garage->owner->id_number,
            $garage->garage_number,
            $garage->registration_number,
            $garage->registry_number,
            $garage->owner->contact_number
        ];

        // return [
        //     $vehicle->id,
        //     $vehicle->blacklist ? 'Bəli' : 'Xeyr',
        //     $vehicle->comment,
        //     optional($vehicle->company)->name,
        //     optional($vehicle->complex)->name,
        //     optional($vehicle->building)->name,
        //     $vehicle->vehicle_registration,
        //     optional($vehicle->apartment)->apartment_number,
        //     optional($vehicle->object)->name,
        //     $vehicle->number_type,
        //     $vehicle->foreign_number,
        //     $vehicle->region_number,
        //     $vehicle->first_letter,
        //     $vehicle->second_letter,
        //     $vehicle->plate_number,
        //     optional($vehicle->vehicleType)->name,
        //     optional($vehicle->color)->name,
        //     optional($vehicle->brand)->name,
        //     $vehicle->has_service ? 'Bəli' : 'Xeyr',
        //     $vehicle->has_garage ? 'Bəli' : 'Xeyr',
        //     optional($vehicle->garageBuilding)->name,
        //     optional($vehicle->garage)->name,
        //     implode(', ', collect($vehicle->contact_numbers)->map(function ($item) {
        //         return $item['fields']['phone'] ?? null;
        //     })->filter()->toArray()),
        //     $vehicle->status,
        // ];
    }
}
