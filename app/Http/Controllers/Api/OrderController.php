<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Http\Resources\OrderResource;
use App\Interfaces\OrderInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    private OrderInterface $itemRepository;
    public function __construct(OrderInterface $item)
    {
        $this->itemRepository = $item;
    }
    public function index()
    {
        $items = $this->itemRepository->index_user(auth('api')->id());
        return $this->returnData(OrderResource::collection($items), null, $this->make_pagination($items));
    }

    public function show($id)
    {
        $item = $this->itemRepository->show($id);
        if ($item) {
            return $this->returnData(new OrderResource($item));
        }

        return $this->returnError('العنصر غير موجود');
    }


    public function store(OrderRequest $request)
    {
        if (!auth('api')->user()->carts->count()) {
            return $this->returnError('لايمكن انشاء الطلب والسله فارغة');
        }
        $this->itemRepository->store($request->all());
        return $this->returnSuccessMessage('تم انشاءالطلب بنجاح');
    }
}
