<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;

class ProductRepository implements ProductInterface
{
    public function index()
    {
        return Product::where(function ($q) {
            if (request('search')) {
                $q->where('name', 'LIKE', '%' . request('search') . '%');
            }
        })->latest()->paginate(15);
    }
    public function show($id)
    {
        return Product::find($id);
    }
}
