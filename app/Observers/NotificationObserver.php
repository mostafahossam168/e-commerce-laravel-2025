<?php

namespace App\Observers;

use App\Models\Notification;
use App\Services\FCMClient;

class NotificationObserver
{
    /**
     * Handle the Notification "created" event.
     */
    public function created(Notification $notification): void
    {

        // event(new NotificationEvent($notification->user_id, $notification));

        $tokens = $notification->user?->fcm_token;
        $data = [];
        // if ($notification->type_id) {
        //     $data['id'] = $notification->type_id;
        // }
        // if ($notification->type) {
        //     $data['type'] = $notification->type;
        // }
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