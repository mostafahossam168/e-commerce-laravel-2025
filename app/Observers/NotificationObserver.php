<?php

namespace App\Observers;

use App\Events\NewNotificationEvent;
use Carbon\Carbon;
use App\Events\TestEvent;
use App\Services\FCMClient;
use App\Models\Notification;
use App\Events\NotificationEvent;

class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     */
    public function created(Notification $notification): void
    {
        event(new NewNotificationEvent($notification));
        $tokens = $notification->user?->fcm_tokens;
        $data = [];
        foreach ($tokens ?? [] as $token) {
            FCMClient::send($token, $notification, $data);
        }
    }

    /**
     * Handle the Notification "updated" event.
     */
    public function updated(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "deleted" event.
     */
    public function deleted(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "restored" event.
     */
    public function restored(Notification $notification): void
    {
        //
    }

    /**
     * Handle the Notification "force deleted" event.
     */
    public function forceDeleted(Notification $notification): void
    {
        //
    }
}