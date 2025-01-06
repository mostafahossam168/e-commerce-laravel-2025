<?php

namespace App\Repositories;

use App\Http\Resources\CartResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Interfaces\CartInterface;
use Illuminate\Support\Facades\DB;

class CartRepository implements CartInterface
{
    public function index()
    {
        $userId = auth('api')->id();
        $query = DB::table('carts')
            ->where('ip', request()->ip())
            ->where('session_id', request()->session()->getId());
        if ($userId) {
            $query->where('user_id', $userId);
        }


        $products = $query->get();

        $data['products'] = CartResource::collection($products);
        $data['subtotal'] = $products->sum(function ($product) {
            return $product->price * $product->qty;
        });
        $data['tax'] =  setting('is_tax') ? ($data['subtotal'] * setting('tax') / 100) : 0;
        $data['total'] = $data['subtotal'] +  $data['tax'];
        return $data;
    }




    public function addToCart($request, $id)
    {
        $product = Product::find($id);

        if (!$product) {
            return false;
        }

        $userId = auth('api')->id();
        $sessionId = request()->session()->getId();
        $ip = request()->ip();


        $item = DB::table('carts')
            ->where('product_id', $id)
            ->where('ip', $ip)
            ->where('session_id', $sessionId)
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->first();

        if ($item) {
            DB::table('carts')
                ->where('id', $item->id)
                ->update([
                    'qty' => $item->qty + $request->qty,
                    'price' => $product->price,
                    'updated_at' => now(),
                ]);
        } else {
            DB::table('carts')->insert([
                'user_id' => $userId,
                'session_id' => $sessionId,
                'ip' => $ip,
                'product_id' => $id,
                'price' => $product->price,
                'qty' => $request->qty ?? 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        return true;
    }

    public function removeFromCart($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return false;
        }
        $userId = auth('api')->id();
        $sessionId = request()->session()->getId();
        $ip = request()->ip();

        DB::table('carts')
            ->where('product_id', $id)
            ->where('ip', $ip)
            ->where('session_id', $sessionId)
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->delete();
        return true;
    }
}
