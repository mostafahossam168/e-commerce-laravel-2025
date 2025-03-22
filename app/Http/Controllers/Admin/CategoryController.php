<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Interfaces\CategoryInterface;
use Illuminate\Http\Request;

class CategoryController extends \Illuminate\Routing\Controller
{
    private CategoryInterface $itemRepository;
    public function __construct(CategoryInterface $item)
    {
        $this->itemRepository = $item;
        $this->middleware('permission:read_admins|create_categories|update_categories|delete_categories', ['only' => ['index', 'store']]);
        $this->middleware('permission:create_categories', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_categories', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_categories', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepository->index();
        return view('admin.categories.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $this->itemRepository->store($request->all());
        return back()->with('success', 'تم انشاء القسم بنجاح ');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $this->itemRepository->update($request->all(), $id);
        return back()->with('success', 'تم تعديل القسم بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->itemRepository->destroy($id);
        return back()->with('success', 'تم حذف القسم بنجاح ');
    }
}