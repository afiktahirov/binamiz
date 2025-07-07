<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Building;
use Illuminate\Http\Request;

         
class InformationController extends Controller
{
    public function index()
    {
        $userProfile = auth()->user()->profile()->withCount([
               'apartments',
               'apartments as apartments_with_tenant_count' => fn($query) => $query->whereNotNull('tenant_id'),
               'garages',
               'garages as garages_with_tenant_count' => fn($query) => $query->whereNotNull('tenant_id'),
               'objects',
               'objects as objects_with_tenant_count' => fn($query) => $query->whereNotNull('tenant_id'),
               'vehicles',
               'vehiclesWithTenant as vehicles_with_tenant_count'
           ])->firstOrFail();
           
        $cardData = [
            'apartments' => $userProfile->apartments_count,
            'apartments_with_tenant' => $userProfile->apartments_with_tenant_count,
            'garages' => $userProfile->garages_count,
            'garages_with_tenant' => $userProfile->garages_with_tenant_count,
            'objects' => $userProfile->objects_count,
            'objects_with_tenant' => $userProfile->objects_with_tenant_count,
            'vehicles' => $userProfile->vehicles_count,
            'vehicles_with_tenant' => $userProfile->vehicles_with_tenant_count
        ];

        $userProfileId = $userProfile->id;

        // Get user's apartments
        $userApartments = \App\Models\Apartment::where('owner_id', $userProfileId)->get();

        // Get company and complex id
        $complex_ids = $userApartments->pluck('complex_id')->unique();

        // Get unique building IDs
        $buildingIds = $userApartments->pluck('building_id')->unique();

        // Fetch buildings
        $userBuildings = \App\Models\Building::whereIn('complex_id', $complex_ids)
                ->with([
                    'apartments' => fn($q) => $q->select(['id', 'building_id', 'total_area', 'living_area', 'owner_id']),
                    'garages' => fn($q) => $q->select(['id', 'building_id', 'garage_number', 'size', 'owner_id']),
                    'objects' => fn($q) => $q->select(['id', 'building_id', 'object_number', 'size', 'owner_id']),
                    'complex' => fn($q) => $q->select(['id', 'residential_price', 'non_residential_price', 'garage_price']),
                    'comunals' => fn($q) => $q->select(['id', 'building_id', 'owner_id', 'property_type', 'apartment_id', 'object_id', 'garage_id'])
                        ->with(['debts' => fn($q) => $q->select(['id', 'comunal_id', 'total_amount', 'status'])->where('status', 1)])
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
                'total_debt_percent' => round(($total_debt_amount * 100) / $total_amount, 2)
            ];
        }


        return view('account.information.index',[
            'cardData' => $cardData,
            'buildingCardData' => $buildingCardData,
            'title' => 'Məlumat Masaı'
        ]);
    }
}
