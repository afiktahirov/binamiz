<?php

namespace App\Nova\Actions;

use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VehiclesExport;
use Laravel\Nova\Http\Requests\NovaRequest;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportVehicles extends Action
{
    public $name = 'Excelə Yüklə (Seçilmişlər)';

    public function handle(ActionFields $fields, Collection $models)
    {
        $ids = $models->pluck('id')->toArray();

        // Store the Excel file temporarily
        $filename = 'exported_vehicles_' . now()->format('Y_m_d_His') . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);

        \Maatwebsite\Excel\Facades\Excel::store(new VehiclesExport($ids), 'public/' . $filename);

        // Return download response using Nova's Action::download()
        return Action::download(asset('storage/' . $filename), 'Avtomobillər '.now()->format('Y_m_d_His').'.xlsx');
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
