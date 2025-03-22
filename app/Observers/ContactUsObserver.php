<?php

namespace App\Observers;

use App\Models\User;
use App\Models\ContactUs;
use App\Models\Notification;
use App\Events\NotificationEvent;

class ContactUsObserver
{
    /**
     * Handle the ContactUs "created" event.
     */
    public function created(ContactUs $contactUs): void
    {
        $admins = User::admins()->select('id')->get();
        foreach ($admins as $admin) {
            Notification::send($admin->id, 'رسالة جديده', route('admin.contacts'));
        }
    }

    /**
     * Handle the ContactUs "updated" event.
     */
    public function updated(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "deleted" event.
     */
    public function deleted(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "restored" event.
     */
    public function restored(ContactUs $contactUs): void
    {
        //
    }

    /**
     * Handle the ContactUs "force deleted" event.
     */
    public function forceDeleted(ContactUs $contactUs): void
    {
        //
    }
}