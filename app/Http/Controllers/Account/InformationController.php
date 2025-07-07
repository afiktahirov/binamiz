<?php

namespace App\Http\Controllers\Account;

use Carbon\Carbon;
use App\Models\Building;
use App\Models\Apartment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

         
class InformationController extends Controller
{
    public function index()
    {

        // Get company and complex id
        $complex_ids = auth()->user()->company()->with('complexs:id')->pluck('id');

        // $userProfile = auth()->user()->profile()->withCount([
        //        'apartments',
        //        'apartments as apartments_with_tenant_count' => fn($query) => $query->whereNotNull('tenant_id'),
        //        'garages',
        //        'garages as garages_with_tenant_count' => fn($query) => $query->whereNotNull('tenant_id'),
        //        'objects',
        //        'objects as objects_with_tenant_count' => fn($query) => $query->whereNotNull('tenant_id'),
        //        'vehicles',
        //        'vehiclesWithTenant as vehicles_with_tenant_count'
        //    ])->firstOrFail();

        $apartments = DB::table('apartments')->whereIn('complex_id',$complex_ids);
        $total_apartments = DB::table('blocks')
                        ->whereIn('complex_id',$complex_ids)
                        ->where('company_id', auth()->user()->company->id)
                        ->sum('total_flats');
                        
        $garages = DB::table('garages')->whereIn('complex_id',$complex_ids);
        $objects = DB::table('objects')->whereIn('complex_id',$complex_ids);
        $vehicles = DB::table('vehicles')->whereIn('complex_id',$complex_ids);
        
        $total_garages = DB::table('buildings')
                        ->whereIn('complex_id',$complex_ids)
                        ->where('company_id', auth()->user()->company->id)
                        ->sum('garage_count');
        
        $vehicles_with_tenant = DB::table('vehicles')
            ->join('apartments', 'vehicles.apartment_id', '=', 'apartments.id')
            ->whereIn('apartments.complex_id', $complex_ids)
            ->count();


        $cardData = [
            'apartments' => $total_apartments,
            'apartments_with_tenant' => $apartments->whereNotNull('tenant_id')->count(),

            'garages' => $total_garages,
            'garages_with_tenant' => $garages->count(),
            // 'garages_with_tenant' => $garages->whereNotNull('tenant_id')->count(),
            
            'objects' => $objects->count(),
            'objects_with_tenant' => $objects->whereNotNull('tenant_id')->count(),
            
            'vehicles' => $vehicles->count(),
            'vehicles_with_tenant' => $vehicles_with_tenant

        ];

        $currentMonth = Carbon::now()->month;
        $currentYear = Carbon::now()->year;

        // Fetch buildings
        $userBuildings = \App\Models\Building::whereIn('complex_id', $complex_ids)
            ->where('company_id', auth()->user()->company->id)
            ->with([
                'apartments' => fn($q) => $q->select(['id', 'building_id', 'total_area', 'living_area', 'owner_id']),
                'garages' => fn($q) => $q->select(['id', 'building_id', 'garage_number', 'size', 'owner_id']),
                'objects' => fn($q) => $q->select(['id', 'building_id', 'object_number', 'size', 'owner_id']),
                'complex' => fn($q) => $q->select(['id', 'residential_price', 'non_residential_price', 'garage_price']),
                'comunals' => fn($q) => $q->select(['id', 'building_id', 'owner_id', 'property_type', 'apartment_id', 'object_id', 'garage_id'])
                    ->with([
                        'debts' => fn($q) => $q->select(['id', 'comunal_id', 'total_amount', 'status', 'created_at'])
                            ->where('status', 1)
                            ->whereMonth('created_at', $currentMonth)
                            ->whereYear('created_at', $currentYear)
                    ])
            ])
            ->get();
        
        
        $buildingCardData = [];
        // return $userBuildings;
        foreach($userBuildings as $building)
        {
            $total_living_area = $building?->apartments->sum('living_area');

            $total_garage_size = $building?->garages->sum('size');

            $total_object_size = $building?->objects->sum('size');

            
            $total_amount = ($total_living_area * $building?->complex?->residential_price) +
                            ($total_garage_size * $building?->complex?->garage_price) +
                            ($total_object_size * $building?->complex?->non_residential_price);

            $total_debt_amount = $building->comunals
                ->flatMap(fn($comunal) => $comunal?->debts)
                ->sum('total_amount');

            $buildingCardData[] = [
                'building_name' => $building->name,
                'total_amount' => $total_amount,
                'total_debt_amount' => $total_debt_amount,
                'total_debt_percent' => round(($total_debt_amount * 100) / $total_amount, 2),
            ];
        }

        // Only get debts from buildings user owns
        $buildingIdsArray = $userBuildings->pluck('id')->toArray();

        $monthlyDebtByBuilding = DB::table('debts')
            ->join('comunals', 'debts.comunal_id', '=', 'comunals.id')
            ->join('buildings', 'comunals.building_id', '=', 'buildings.id')
            ->select(
                'buildings.name as building',
                DB::raw('MONTH(debts.created_at) as month'),
                DB::raw('SUM(debts.total_amount) as total_amount')
            )
            ->where('debts.status', 1)
            ->whereYear('debts.created_at', $currentYear)
            ->whereIn('buildings.id', $buildingIdsArray)
            ->groupBy('buildings.name', DB::raw('MONTH(debts.created_at)'))
            ->orderBy('building')
            ->orderBy('month')
            ->get();

        // dd($monthlyDebtByBuilding);
        $groupedChartData = [];

        foreach ($monthlyDebtByBuilding as $row) {
            $groupedChartData[$row->building][$row->month] = $row->total_amount;
        }
        
        $labels = ["Yanvar", "Fevral", "Mart", "Aprel", "May", "İyun", "İyul", "Avqust", "Sentyabr", "Oktyabr", "Noyabr", "Dekabr"];

        $finalChartData = [];
    
        foreach ($groupedChartData as $building => $monthlyData) {
            $data = [];
            for ($i = 1; $i <= 12; $i++) {
                $finalChartData['data'][$building][] = $monthlyData[$i] ?? 0;
            }
            // $finalChartData['data'] = $data;
        }

        $finalChartData['labels'] = $labels;

        return view('account.information.index',[
            'cardData' => $cardData,
            'buildingCardData' => $buildingCardData,
            'title' => 'Məlumat Masaı',
            'chartData' => $finalChartData,
        ]);
    }
}
