<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AddCartRequest;
use App\Http\Resources\CartProductResource;
use App\Http\Resources\CartResource;
use App\Interfaces\CartInterface;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    private CartInterface $itemRepository;
    public function __construct(CartInterface $item)
    {
        $this->itemRepository = $item;
    }

    public function index()
    {
        $data = $this->itemRepository->index();
        return $this->returnData($data);
    }

    public function addToCart(AddCartRequest $request, $id)
    {

        $data = $this->itemRepository->addToCart($request, $id);
        if ($data) {
            return $this->returnSuccessMessage('تم اضافة المنتج للسلة بنجاح');
        }
        return $this->returnError('حدث خطأ');
    }
    public function removeFromCart($id)
    {
        $data = $this->itemRepository->removeFromCart($id);
        if ($data) {
            return $this->returnSuccessMessage('تم الازالة من السله بنجاح');
        }
        return $this->returnError('حدث خطأ');
    }
}
