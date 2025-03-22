<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Interfaces\NotificationInterface;
use Illuminate\Http\Request;

class NotificationController extends \Illuminate\Routing\Controller
{
    private NotificationInterface $itemRepository;
    public function __construct(NotificationInterface $item)
    {
        $this->itemRepository = $item;
        $this->middleware('permission:read_notifications', ['only' => ['index']]);
    }

    public function index()
    {
        $notifications = $this->itemRepository->index();
        $this->itemRepository->markAsRead();
        return view('admin.notifications', compact('notifications'));
    }
}