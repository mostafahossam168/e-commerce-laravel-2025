<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Http\Resources\FavoriteResource;
use App\Http\Resources\ProductResource;
use App\Interfaces\FavoriteInterface;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    private FavoriteInterface $itemRepository;
    public function __construct(FavoriteInterface $item)
    {
        $this->itemRepository = $item;
    }

    public function index()
    {
        $data = $this->itemRepository->index();
        return $this->returnData(FavoriteResource::collection($data));
    }
    public function addToFavorite($id)
    {
        $product = $this->itemRepository->addToFavorite($id);
        if ($product) {
            return $this->returnSuccessMessage('تم اضافة المنتج للمفضله بنجاح');
        }
        return $this->returnError('حدث خطأ');
    }
    public function removeFromFavorite($id)
    {
        $product = $this->itemRepository->removeFromFavorite($id);
        if ($product) {
            return $this->returnSuccessMessage('تم حذف المنتج من المفضله بنجاح');
        }
        return $this->returnError('حدث خطأ');
    }
}
