<?php
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Http\Request;

class VehicleController extends Controller {


    public function index() {
        
        $user = auth()->user();

        $ownerOrTenant = $user->ownerOrTenant()->first(['id']);
        
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

        $user = auth()->user();

        $ownerOrTenant = $user->ownerOrTenant()->first(['id']);

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

        return response()->json($vehicle, 200);
    }
}
