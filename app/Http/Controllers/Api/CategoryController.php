<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryInterface $itemRepository;
    public function __construct(CategoryInterface $item)
    {
        $this->itemRepository = $item;
    }
    public function index(Request $request)
    {
        $categories = $this->itemRepository->index();
        return $this->returnData(CategoryResource::collection($categories), null, $this->make_pagination($categories));
    }
    public function show($id)
    {
        $category = $this->itemRepository->show($id);
        if ($category) {
            return $this->returnData(new CategoryResource($category));
        }
        return $this->returnError('العنصر غير موجود');
    }
}
