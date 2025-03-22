<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private ProductInterface $itemRepository;
    public function __construct(ProductInterface $item)
    {
        $this->itemRepository = $item;
    }
    public function index(Request $request)
    {
        $products = $this->itemRepository->index();
        return $this->returnData(ProductResource::collection($products), null, $this->make_pagination($products));
    }
    public function show($id)
    {
        $product = $this->itemRepository->show($id);
        if ($product) {
            return $this->returnData(new ProductResource($product));
        }
        return $this->returnError('العنصر غير موجود');
    }
}
