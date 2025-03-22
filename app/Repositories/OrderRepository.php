<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderInterface;
use App\Services\CartService;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderInterface
{
    public function index()
    {
        return Order::where(function ($q) {
            if (request('status')) {
                $q->where('status', request('status'));
            }
            if (request('search')) {
                $q->where('number', 'LIKE', '%' . request('search') . '%');
            }
            if (request('user')) {
                $q->where('user_id', request('user'));
            }
        })->latest()->paginate(15);
    }
    public function index_user($user_id)
    {
        return Order::where('user_id', $user_id)->where(function ($q) {
            if (request('status')) {
                $q->where('status', request('status'));
            }
            if (request('search')) {
                $q->where('number', 'LIKE', '%' . request('search') . '%');
            }
        })->latest()->paginate(15);
    }
    public function show($id)
    {
        return Order::find($id);
    }
    public function create() {}
    public function store($request)
    {
        $data = $request;
        $userId = auth('api')->id();
        $query = DB::table('carts')
            ->where('ip', request()->ip())
            ->where('session_id', request()->session()->getId());
        if ($userId) {
            $query->where('user_id', $userId);
        }


        $carts = $query->get();

        $data['status'] = 'pending';
        $data['subtotal'] = CartService::getCart()['subtotal'];
        $data['tax'] = CartService::getCart()['tax'];
        $data['total'] = CartService::getCart()['total'];
        $order =  auth('api')->user()->orders()->create($data);
        foreach ($carts as $item) {
            $order->products()->create(
                [
                    'product_id' => $item->product_id,
                    'price' => $item->price,
                    'qty' => $item->qty,
                ]
            );
        }


        CartService::deleteCart();
        return $order;
    }
    public function edit($id) {}
    public function update($request, $id) {}
    public function destroy($id)
    {
        $order =  Order::findOrFail($id);
        return  $order->delete();
    }





    public function confirm($id)
    {
        $order =  Order::findOrFail($id);
        return $order->update(['status' => "preparing"]);
    }
    public function canceled($id, $request)
    {
        $order =  Order::findOrFail($id);
        return $order->update([
            'status' => "canceled",
            'resone_canceled' => $request->resone_canceled,
        ]);
    }
    public function complete($id)
    {
        $order =  Order::findOrFail($id);
        return $order->update(['status' => "completed"]);
    }
}