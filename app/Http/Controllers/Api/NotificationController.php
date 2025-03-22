<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\NotificationResource;
use App\Interfaces\NotificationInterface;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    private NotificationInterface $itemRepository;
    public function __construct(NotificationInterface $item)
    {
        $this->itemRepository = $item;
    }
    public function index()
    {
        $data = $this->itemRepository->index();
        return $this->returnData(NotificationResource::collection($data), null, $this->make_pagination($data));
    }
    public function markAsRead()
    {
        $this->itemRepository->markAsRead();
        return $this->returnSuccessMessage('تم قراءة جميع الاشعارات  بنجاح');
    }
}
