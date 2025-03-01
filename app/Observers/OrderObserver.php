<?php

namespace App\Observers;

use App\Models\User;
use App\Models\Order;
use App\Events\TestEvent;
use App\Models\Notification;
use App\Services\CartService;
use App\Events\NewNotificationEvent;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $admins = User::admins()->select('id')->get();
        foreach ($admins as $admin) {
            Notification::send($admin->id, " تم اضافة طلب جديد رقم {$order->number} ", route('admin.orders.show', $order->id));
        }
    }

    /**
     * Handle the Order "updated" event.
     */
    public function updated(Order $order): void
    {
        $message = '';
        if ($order->status->name() == 'تحت التجهيز') {
            $message = "تم الموافقه علي طلبك رقم  $order->number";
        } elseif ($order->status->name() == 'ملغى') {
            $message = "تم  رفض  طلبك رقم  $order->number بسبب : $order->resone_canceled";
        } elseif ($order->status->name() == 'مكتمل') {
            $message = "تم اكتمال طلبك رقم  $order->number";
        }
        event(new NewNotificationEvent("Mostafa Hossam"));
        Notification::send($order->user?->id, $message, route('admin.orders.show', $order->id));
    }

    /**
     * Handle the Order "deleted" event.
     */
    public function deleted(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     */
    public function restored(Order $order): void
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     */
    public function forceDeleted(Order $order): void
    {
        //
    }
}