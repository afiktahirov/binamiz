<?php

namespace App\Http\Controllers\Account;

use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceTypeController extends Controller
{
    
    public function show($id) {

        $services = Service::where('service_type_id', $id)
            ->with(['serviceType'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('account.service-types.index', [
            'title' => 'Xidmət Növləri',
            'services' => $services
        ]);
    }

}
