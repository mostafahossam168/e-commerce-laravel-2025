<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class ProductController extends \Illuminate\Routing\Controller
{
    private ProductInterface $itemRepository;
    public function __construct(ProductInterface $item)
    {
        $this->itemRepository = $item;

        $this->middleware('permission:read_products|create_products|update_products|delete_products', ['only' => ['index', 'store']]);
        $this->middleware('permission:create_products', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_products', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_products', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepository->index();
        return view('admin.products.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = $this->itemRepository->create()['categories'];
        return view('admin.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->except('images', 'main_image');
        $data['main_image'] = store_file($request->main_image, 'products');
        $images = [];
        if ($request->images) {
            foreach ($request->images as $image) {
                $images[] = store_file($image, 'products');
            }
        }
        $this->itemRepository->store(['data' => $data, 'images' => $images]);
        return redirect()->route('admin.products.index')->with('success', 'تم الحفظ بنجاح');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = $this->itemRepository->show($id);
        return view('admin.products.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = $this->itemRepository->edit($id)['item'];
        $categories = $this->itemRepository->edit($id)['categories'];
        return view('admin.products.edit', compact('categories', 'item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $product = $this->itemRepository->show($id);
        $data = $request->except('images', 'main_image');
        if ($request->main_image != null) {
            delete_file($product->main_image);
            $data['main_image'] = store_file($request->main_image, 'products');
        }

        $images = [];
        if ($request->images) {
            foreach ($request->images as $image) {
                $images[] = store_file($image, 'products');
            }
        }
        $this->itemRepository->update(['data' => $data, 'images' => $images], $id);
        return redirect()->route('admin.products.index')->with('success', 'تم تعديل المنتج بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->itemRepository->destroy($id);
        return back()->with('success', 'تم حذف المنتج بنجاح ');
    }
}