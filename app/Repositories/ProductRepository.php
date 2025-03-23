<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Category;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function index()
    {
        return Product::where(function ($q) {
            if (request('search')) {
                $q->where('name', 'LIKE', '%' . request('search') . '%')
                    ->orWhere('id', request('search'));
            }
            if (request('status')) {
                if (request('status') == 'yes') {
                    $q->where('status', 1);
                } else {
                    $q->where('status', 0);
                }
            }
        })->latest()->paginate(15);
    }
    public function show($id)
    {
        return Product::find($id);
    }


    public function create()
    {
        $data['categories'] = Category::active()->get();
        return $data;
    }
    public function store($request)
    {
        $images = $request['images'];
        $data = $request['data'];
        $product = Product::create($data);
        foreach ($images as $image) {
            $product->images()->create(['path' => $image]);
        }
        return $product;
    }
    public function edit($id)
    {
        $data['item'] = Product::findOrFail($id);
        $data['categories'] = Category::active()->get();
        return $data;
    }
    public function update($request, $id)
    {
        $images = $request['images'];
        $data = $request['data'];
        $product = Product::find($id);
        $product->update($data);
        if ($images) {
            foreach ($product->images as $image) {
                delete_file($image->path);
                $image->delete();
            }
            foreach ($images as $image) {
                $product->images()->create(['path' => $image]);
            }
        }
        return $product;
    }
    public function destroy($id)
    {
        $product =  Product::findOrFail($id);
        delete_file($product->main_image);
        foreach ($product->images as $image) {
            delete_file($image->path);
            $image->delete();
        }
        return  $product->delete();
    }
}