<?php
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use App\Models\Vehicle;
use Illuminate\Http\Request;

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
            
        return view('account.vehicle.index', [
            'vehicles' => $vehicles,
            'title' => 'Vehicles',
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
            ])
            ->first();
            
            $vehicle->full_number = $vehicle->fullNumber();
            
        if(!$vehicle){
            return response()->json(['error' => 'Vehicle not found'], 404);
        }

        return response()->json($vehicle, 200);
    }
}
