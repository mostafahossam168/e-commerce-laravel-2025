<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryRepository  implements CategoryInterface
{
    public function index()
    {
        return Category::where(function ($q) {
            if (request('search')) {
                $q->where('name', 'LIKE', '%' . request('search') . '%');
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
        return Category::find($id);
    }
    public function store($request)
    {
        return Category::create($request);
    }
    public function update($request, $id)
    {
        $category =  Category::find($id);
        return $category->update($request);
    }
    public function destroy($id)
    {
        $category =  Category::find($id);
        return  $category->delete();
    }
}
