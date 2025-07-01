<?php
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
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
            
            $vehicle->full_number = $vehicle->fullNumber();
            
        if(!$vehicle){
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        return response()->json($vehicle, 200);
    }
}
