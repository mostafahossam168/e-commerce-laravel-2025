<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Interfaces\OrderInterface;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use App\Models\Order;

class OrderController extends \Illuminate\Routing\Controller
{

    private OrderInterface $itemRepository;
    public function __construct(OrderInterface $item)
    {
        $this->itemRepository = $item;

        $this->middleware('permission:read_orders|create_orders|update_orders|delete_orders', ['only' => ['index', 'store']]);
        $this->middleware('permission:create_orders', ['only' => ['create', 'store']]);
        $this->middleware('permission:update_orders', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_orders', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = $this->itemRepository->index();
        return  view('admin.orders.index', compact('items'));
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
    public function store(OrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = $this->itemRepository->show($id);
        return view('admin.orders.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = $this->itemRepository->show($id);
        return view('admin.orders.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $this->itemRepository->destroy($id);
        return back()->with('success', 'تم حذف الطلب بنجاح ');
    }



    public function confirm($id)
    {
        $this->itemRepository->confirm($id);
        return back()->with('success', 'تم تاكيد الطلب بنجاح ');
    }
    public function canceled($id, OrderRequest $request)
    {
        $this->itemRepository->canceled($id, $request);
        return back()->with('success', 'تم الغاء الطلب بنجاح ');
    }
    public function complete($id)
    {
        $this->itemRepository->complete($id);
        return back()->with('success', 'تم اكتمال الطلب بنجاح ');
    }
}