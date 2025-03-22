<?php

namespace App\Repositories;

use App\Interfaces\NotificationInterface;
use App\Models\Notification;

class NotificationRepository implements NotificationInterface
{
    public function index()
    {
        
        return  Notification::where('user_id', auth()->id())->latest()->paginate(30);
    }
    public function markAsRead()
    {
        return  Notification::where('user_id', auth()->id())->update(['seen_at' => now()]);
    }
}