<?php

namespace App\Observers;

use App\Models\Notification;
use App\Models\Order;
use App\Models\User;
use App\Services\CartService;

class OrderObserver
{
    /**
     * Handle the Order "created" event.
     */
    public function created(Order $order): void
    {
        $admins = User::admins()->select('id')->get();
        foreach ($admins as $admin) {
            Notification::send($admin->id, " تم اضافة طلب جديد رقم {$order->number} ", route('admin.orders.index'));
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
        Notification::send($order->user?->id, $message, route('admin.orders.index'));
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
