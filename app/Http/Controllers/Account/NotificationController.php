<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\NotificationModel;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    
    public function index(Request $request) {

        $user = auth()->user();
        $query = NotificationModel::where(function($q){
                    $q->where('notifications.target_user_type', auth()->user()->role)
                        ->orWhere('notifications.target_user_type', 'all');
                })->select('notifications.*')

                ->selectRaw('CASE WHEN notification_reads.id IS NOT NULL THEN true ELSE false END as is_readed')

                ->leftJoin('notification_reads', function($join) {
                    $join->on('notifications.id', '=', 'notification_reads.notification_id')
                        ->where('notification_reads.user_id', '=', auth()->id());
                });


        if ($request->filled("search")) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where("title", "like", "%{$search}%")
                    ->orWhere("content", "like", "%{$search}%")
                    ->orWhere("type", "like", "%{$search}%");
            });
        }

        // Sorting functionality
        $sortBy = $request->get("sort_by", "created_at");
        $sortDirection = $request->get("sort_direction", "desc");

        $allowedSorts = [
            "title",
            "type",
            "is_readed",
            "created_at",
        ];

        if (in_array($sortBy, $allowedSorts)) 
            $query->orderBy($sortBy, $sortDirection);
        else 
            $query->orderBy("created_at", "desc");
        

        // Pagination
        $perPage = $request->get("per_page", 10);
        $allowedPerPage = [10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $notifications = $query->paginate($perPage);
        $notifications->appends($request->query());
        $notifications->withPath(request()->url());

        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                "html" => view(
                    "account.notification.table",
                    compact("notifications")
                )->render(),
                "pagination" => [
                    "current_page" => $notifications->currentPage(),
                    "last_page" => $notifications->lastPage(),
                    "per_page" => $notifications->perPage(),
                    "total" => $notifications->total(),
                    "from" => $notifications->firstItem(),
                    "to" => $notifications->lastItem(),
                    "links" => $notifications
                        ->links("custom.pagination")
                        ->render(),
                ],
            ]);
        }

        // Prepare current state for JavaScript
        $currentState = [
            "search" => $request->get("search", ""),
            "sort_by" => $sortBy,
            "sort_direction" => $sortDirection,
            "per_page" => $perPage,
            "page" => $notifications->currentPage(),
        ];

        return view("account.notification.index", [
                "notifications" => $notifications,
                "title" => "Bildirişlər",
                "currentState" => $currentState,
            ]);
    }

    public function markAsRead($id)
    {
        $notification = \App\Models\NotificationModel::find($id);

        if (!$notification) {
            return response()->json([
                'error' => 'Notification not found.',
            ], 404);
        }

        // Check if the notification is for the current user
        if ($notification->target_user_type !== auth()->user()->role && $notification->target_user_type !== 'all') {
            return response()->json([
                'error' => 'Unauthorized action.',
            ], 403);
        }
        
        if (!$notification->isReadByUser(auth()->id())) {
            $notification->reads()->create(['user_id' => auth()->id(), 'read_at' => now()]);
        }

        return response()->json([
            'message' => 'Notification marked as read.',
        ]);
    }

    public function markAllAsRead()
    {
        $userId = auth()->id();
        $userRole = auth()->user()->role;

        // Get all unread notification IDs
        $unreadNotificationIds = \App\Models\NotificationModel::query()
            ->whereDoesntHave('reads', function($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->where(function($query) use ($userRole) {
                $query->where('target_user_type', $userRole)
                    ->orWhere('target_user_type', 'all');
            })
            ->pluck('id');

        // Bulk insert reads for all unread notifications
        if ($unreadNotificationIds->isNotEmpty()) {
            $now = now();
            $reads = $unreadNotificationIds->map(function($notificationId) use ($userId,$now) {
                return [
                    'notification_id' => $notificationId,
                    'user_id' => $userId,
                    'read_at' => $now,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];
            })->toArray();

            DB::table('notification_reads')->insert($reads);
        }
        
        Cache::forget("notifications");
        
        return response()->json([
            'message' => 'All notifications marked as read.',
        ]);
    }

}
