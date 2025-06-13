<?php

namespace App\Observers;

use App\Models\NotificationRead;

class NotificationReadObserver
{
    /**
     * Handle the NotificationRead "created" event.
     */
    public function created(NotificationRead $notificationRead): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationRead "updated" event.
     */
    public function updated(NotificationRead $notificationRead): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationRead "deleted" event.
     */
    public function deleted(NotificationRead $notificationRead): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationRead "restored" event.
     */
    public function restored(NotificationRead $notificationRead): void
    {
        $this->clearCache();
    }

    /**
     * Handle the NotificationRead "force deleted" event.
     */
    public function forceDeleted(NotificationRead $notificationRead): void
    {
        $this->clearCache();
    }

    private function clearCache(): void
    {
        // Clear the cache for notifications
        \Illuminate\Support\Facades\Cache::forget('notifications');
    }
}
