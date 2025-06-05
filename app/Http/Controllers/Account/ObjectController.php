<?php
declare(strict_types=1);

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use App\Models\Obyekt;
use Illuminate\Http\Request;

class ObjectController extends Controller
{
    public function index()
    {
        $objects = Obyekt::with(['company:id,name,legal_name','complex:id,name','building:id,name'])
            ->ownerOrTenant()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.objects.index', [
            'objects' => $objects,
            'title' => 'Obyektlər',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function detail(int $id)
    {
        $object = Obyekt::with(['company:id,name,legal_name','complex:id,name','building:id,name'])
            ->ownerOrTenant()
            ->where('id', $id)
            ->first();
        return response()->json($object);
    }
}
