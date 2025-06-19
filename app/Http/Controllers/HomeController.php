<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\ServiceType;
use Illuminate\Http\Request;
use App\Enums\ApplicationTypeEnum;
use App\Models\NotificationRead;
use App\Models\NotificationModel;
use App\Services\NotificationService;

class HomeController extends Controller
{
    public function __construct(
        protected NotificationService $notificationService
    )
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $notifications = $this->notificationService->getUserNotifications();
        $otherServices = ServiceType::select('id', 'name', 'icon')
            ->withCount('services')
            ->orderBy('created_at', 'desc')
            ->get();
        

        return view('account.dashboard', [
            'notifications' => $notifications,
            'otherServices' => $otherServices,  
            'cardData' => $this->getCardData(),
        ]);
    }

    private function getCardData()
    {
        return auth()->user()->profile()
            ->withCount(['apartments', 'garages', 'vehicles', 'objects'])
            ->first()
            ->only(['balance','apartments_count', 'garages_count', 'vehicles_count', 'objects_count']) + [
                'other_services_count' => Service::count(),
            ];
    }
}
