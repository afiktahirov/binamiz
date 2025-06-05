<?php
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Garage;
use Illuminate\Http\Request;

class GarageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $garages = Garage::with(['company:id,name,legal_name','complex:id,name','building'])
            ->ownerOrTenant()
            ->orderBy('created_at', 'desc')
            ->simplePaginate(1);

        return view('account.garage.index', [
            'garages' => $garages,
            'title' => 'Garajlar',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function detail(int $id)
    {

        $garages = Garage::with(['company:id,name,legal_name','complex:id,name','building'])
            ->ownerOrTenant()
            ->where('id', $id)
            ->first();

        return response()->json($garages);
    }
}
