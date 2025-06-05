<?php

namespace App\Nova\Actions;

use App\Exports\GaragesExport;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VehiclesExport;
use Laravel\Nova\Http\Requests\ActionRequest;
use Laravel\Nova\Http\Requests\NovaRequest;
use Maatwebsite\LaravelNovaExcel\Actions\DownloadExcel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportGarages extends Action
{
    public $name = 'Excelə Yüklə (Seçilmişlər)';

    public function handle(ActionFields $fields, Collection $models)
    {
        $ids = $models->pluck('id')->toArray();

        // Store the Excel file temporarily
        $filename = 'exported_garages_' . now()->format('Y_m_d_His') . '.xlsx';
        $filePath = storage_path('app/public/' . $filename);

        
        \Maatwebsite\Excel\Facades\Excel::store(new GaragesExport($ids), 'public/' . $filename);

        // Return download response using Nova's Action::download()
        return Action::download(asset('storage/' . $filename), 'Garages '.now()->format('Y_m_d_His').'.xlsx');
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
