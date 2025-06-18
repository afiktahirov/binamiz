<?php

namespace App\Observers;

use App\Models\NotificationModel;

class NotificationModelObserver
{
    /**
     * Handle the NotificationModel "created" event.
     */
    public function created(NotificationModel $notificationModel): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationModel "updated" event.
     */
    public function updated(NotificationModel $notificationModel): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationModel "deleted" event.
     */
    public function deleted(NotificationModel $notificationModel): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationModel "restored" event.
     */
    public function restored(NotificationModel $notificationModel): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationModel "force deleted" event.
     */
    public function forceDeleted(NotificationModel $notificationModel): void
    {
        $this->clearCache();
    }

    public function clearCache(): void
    {
        // Clear the cache for notifications
        \Illuminate\Support\Facades\Cache::forget('notifications');
    }
}
