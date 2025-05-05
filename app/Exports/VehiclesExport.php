<?php

namespace App\Exports;

use App\Models\Vehicle;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class VehiclesExport implements FromCollection, WithHeadings, WithMapping
{
    protected $vehicles;

    public function __construct($vehicles)
    {
        $this->vehicles = $vehicles;
    }

    public function collection()
    {
        return Vehicle::with([
            'company', 'complex', 'building', 'apartment', 'object',
            'vehicleType', 'color', 'brand', 'garageBuilding', 'garage'
        ])->whereIn('id', $this->vehicles)->get();
    }

    public function headings(): array
    {
        return [
            'ID', 'Qara Siyahı', 'Komment', 'Şirkət', 'Kompleks', 'Bina', 'Qeydiyyat Növü',
            'Mənzil', 'Obyekt', 'Nömrə Tipi', 'Xarici Nömrə', 'Region Nömrəsi',
            'Birinci Hərf', 'İkinci Hərf', 'Nömrə', 'Avtomobil Növü',
            'Rəng', 'Marka', 'Servis', 'Qaraj Var', 'Qaraj Binası', 'Qaraj','Telefonlar','Status'
        ];
    }

    public function map($vehicle): array
    {
        return [
            $vehicle->id,
            $vehicle->blacklist ? 'Bəli' : 'Xeyr',
            $vehicle->comment,
            optional($vehicle->company)->name,
            optional($vehicle->complex)->name,
            optional($vehicle->building)->name,
            $vehicle->vehicle_registration,
            optional($vehicle->apartment)->apartment_number,
            optional($vehicle->object)->name,
            $vehicle->number_type,
            $vehicle->foreign_number,
            $vehicle->region_number,
            $vehicle->first_letter,
            $vehicle->second_letter,
            $vehicle->plate_number,
            optional($vehicle->vehicleType)->name,
            optional($vehicle->color)->name,
            optional($vehicle->brand)->name,
            $vehicle->has_service ? 'Bəli' : 'Xeyr',
            $vehicle->has_garage ? 'Bəli' : 'Xeyr',
            optional($vehicle->garageBuilding)->name,
            optional($vehicle->garage)->name,
            implode(', ', collect($vehicle->contact_numbers)->map(function ($item) {
                return $item['fields']['phone'] ?? null;
            })->filter()->toArray()),
            $vehicle->status,
        ];
    }
}
