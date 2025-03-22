<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\ContactUs;
use App\Models\Notification;
use App\Observers\OrderObserver;
use App\Observers\ContactUsObserver;
use Illuminate\Pagination\Paginator;
use App\Observers\NotificationObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Order::observe(OrderObserver::class);
        Notification::observe(NotificationObserver::class);
        ContactUs::observe(ContactUsObserver::class);
    }
}
