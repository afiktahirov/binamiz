<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
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
        
        return view('account.information.index',[
            'cardData' => $cardData
        ]);
    }
}
