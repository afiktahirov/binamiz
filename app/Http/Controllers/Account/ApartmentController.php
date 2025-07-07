<?php 
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use Illuminate\Http\Request;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $apartments = Apartment::with([
                'company:id,name,legal_name',
                'complex:id,name',
                'building:id,name',
                'block:id,block_number'
            ])
            ->where('owner_id', auth()->user()->owner_or_tenant_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('account.apartment.index', [
            'apartments' => $apartments,
            'title' => 'Mənzillər',
        ]);
    }

    public function list(Request $request) {

        $apartments = Apartment::with([
                'company:id,name,legal_name',
                'complex:id,name',
                'building:id,name',
                'block:id,block_number'
            ])
            ->where('owner_id', auth()->user()->owner_or_tenant_id)
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return response()->json($apartments, 200);
    }

    public function detail(int $id)
    {
        $apartment = Apartment::with([
                'company:id,name,legal_name,legal_address',
                'complex:id,name,address,residential_price,garage_price',
                'building:id,name'
            ])
            ->where('owner_id', auth()->user()->owner_or_tenant_id)
            ->where('id', $id)
            ->first();
            
        return response()->json($apartment);
    }
}