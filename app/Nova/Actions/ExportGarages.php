<?php

namespace App\Nova\Actions;

use App\Exports\GaragesExport;
use Laravel\Nova\Actions\Action;
use Illuminate\Support\Collection;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Facades\Storage;
use Laravel\Nova\Http\Requests\NovaRequest;

class ExportGarages extends Action
{
    public $name = 'Excelə Yüklə (Seçilmişlər)';

    public function handle(ActionFields $fields, Collection $models)
    {
        $ids = $models->pluck('id')->toArray();

        // if ($models->pluck('id')->count() !== $models->whereNotNull('renter_id')->count()) {
        //     return Action::danger("Seçdiyiniz qarajlardan bəziləri icarəyə verilməyib. Zəhmət olmasa, yalnız icarəyə verilmiş qarajları seçin.");
        // }

        $filename = 'excel/exported_garages_' . now()->format('Y_m_d_His') . '.xlsx';

        \Maatwebsite\Excel\Facades\Excel::store(new GaragesExport($ids), 'public/' . $filename);

        return Action::download(asset('storage/' . $filename), 'Garages '.now()->format('Y_m_d_His').'.xlsx');
    }

    public function fields(NovaRequest $request)
    {
        return [];
    }
}
