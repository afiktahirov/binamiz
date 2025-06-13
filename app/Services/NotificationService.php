<?php

namespace App\Services;

use App\Models\NotificationModel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Cache;

class NotificationService
{
    public function getUserNotifications($limit = 10): Collection
    {
        return Cache::remember("notifications", 1, function() use ($limit) {
            $userRole = auth()->user()->role;
            $userId = auth()->id();

            $notifications = NotificationModel::query()
                ->where(function($query) use ($userRole) {
                    $query->where('notifications.target_user_type', $userRole)
                        ->orWhere('notifications.target_user_type', 'all');
                })
                ->select('notifications.*')
                ->selectRaw('CASE WHEN notification_reads.id IS NOT NULL THEN true ELSE false END as is_readed')
                ->leftJoin('notification_reads', function($join) use ($userId) {
                    $join->on('notifications.id', '=', 'notification_reads.notification_id')
                        ->where('notification_reads.user_id', '=', $userId);
                })
                ->orderBy('notifications.created_at', 'desc')
                ->limit($limit)
                ->get();

            // Add unread count as a property to the collection
            // $notifications->unreaded_count = NotificationModel::query()
            //     ->whereDoesntHave('reads', function($query) use ($userId) {
            //         $query->where('user_id', $userId);
            //     })
            //     ->where(function($query) use ($userRole) {
            //         $query->where('target_user_type', $userRole)
            //             ->orWhere('target_user_type', 'all');
            //     })
            //     ->count();

            return $notifications;
        });
    }
}
