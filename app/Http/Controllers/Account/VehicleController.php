<?php
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\SearchVehicleByNumberRequest;
use App\Models\RegionNumber;
use App\Models\Tenant;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class VehicleController extends Controller {


    public function index() {
        
        /** @var \App\Models\User $user */
        $user = auth()->user();

        $ownerOrTenant = $user->profile()->first(['id']);
        
        $vehicles = $ownerOrTenant->vehicles()
            ->with([
                'building' => fn($q) => $q->select(['id', 'name']),
                'company' => fn($q) => $q->select(['id', 'name']),
                'complex' => fn($q) => $q->select(['id', 'name']),
                'garage' => fn($q) => $q->select(['id', 'garage_number']),
                'vehicleType' => fn($q) => $q->select(['id', 'name']),
                'color' => fn($q) => $q->select(['id', 'name']),
                'brand' => fn($q) => $q->select(['id', 'name']),
            ])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
        
        $regionNumbers = Cache::remember('region_numbers',60*60*24*7,function(){
            return RegionNumber::orderBy('region_number')->get();
        });
        
        return view('account.vehicle.index', [
            'vehicles' => $vehicles,
            'title' => 'Vehicles',
            'regionNumbers' => $regionNumbers
        ]);
    }

    public function detail(int $id) {

        /** @var \App\Models\User $user */
        $user = auth()->user();

        $ownerOrTenant = $user->profile()->first(['id']);

        $vehicle = $ownerOrTenant->vehicles()
            ->where('vehicles.id', $id)
            ->with([
                'building' => fn($q) => $q->select(['id', 'name']),
                'company' => fn($q) => $q->select(['id', 'name']),
                'complex' => fn($q) => $q->select(['id', 'name']),
                'garage' => fn($q) => $q->select(['id', 'garage_number']),
                'vehicleType' => fn($q) => $q->select(['id', 'name']),
                'color' => fn($q) => $q->select(['id', 'name']),
                'brand' => fn($q) => $q->select(['id', 'name']),
                'comments'
            ])
            ->first();
            
            if($vehicle)
                $vehicle->full_number = $vehicle->fullNumber();
            
        if(!$vehicle){
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        return response()->json($vehicle, 200);
    }
    
    
    public function searchByNumber(SearchVehicleByNumberRequest $request)
    {
        $validated = $request->validated();
        
        $vehicle = Vehicle::with([
                'building' => fn($q) => $q->select(['id', 'name']),
                'garage' => fn($q) => $q->select(['id', 'garage_number']),
                'vehicleType' => fn($q) => $q->select(['id', 'name']),
                'color' => fn($q) => $q->select(['id', 'name']),
                'brand' => fn($q) => $q->select(['id', 'name']),
                'comments' => fn($q) => $q->where('is_active',true)->latest()->first()
            ])
            ->where('is_active',1)
            ->where('region_number',$validated['region_number'])
            ->where('first_letter',$validated['series_first_letter'])
            ->where('second_letter',$validated['series_second_letter'])
            ->where('plate_number',$validated['plate_number'])
            ->first();
        
        if($vehicle)
            $vehicle->full_number = $vehicle->fullNumber();
            
        return response()->json([
            'status' => 'success',
            'message' => $vehicle ? 'Vehicle found' : 'Vehicle not found',
            'data' => $vehicle
        ]);
        
    }
    
}
