<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddRateRequest;
use App\Http\Resources\RateResource;
use App\Interfaces\ProductInterface;
use App\Interfaces\RateInterface;
use Illuminate\Http\Request;

class RateController extends Controller
{
    private RateInterface $itemRepository;
    public function __construct(RateInterface $item)
    {
        $this->itemRepository = $item;
    }

    public function index($product_id)
    {
        $rates = $this->itemRepository->index($product_id);
        if ($rates) {
            return $this->returnData(RateResource::collection($rates));
        }
        return $this->returnError('حدث خطأ');
    }



    public function addRate(AddRateRequest $request, $product_id)
    {
        $rate = $this->itemRepository->addRate($request, $product_id);
        if ($rate) {
            return $this->returnSuccessMessage('تم تقييم المنتج  بنجاح');
        }
        return $this->returnError('حدث خطأ');
    }
    public function removeRate($product_id)
    {
        $rate = $this->itemRepository->removeRate($product_id);
        if ($rate) {
            return $this->returnSuccessMessage('تم حذف تقييمك  بنجاح');
        }
        return $this->returnError('حدث خطأ');
    }
}
