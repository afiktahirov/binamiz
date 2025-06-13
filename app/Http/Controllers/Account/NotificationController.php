<?php

namespace App\Http\Controllers\Account;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

class NotificationController extends Controller
{
    
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
