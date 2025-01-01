<?php

namespace App\Services;



class CartService
{
    public static function getCart()
    {


        // if (auth()->check()) {
        //     return 1;
        // } else {
        //     return 0;
        // }

        $user = auth('sanctum')->user();
        if ($user) {
            $carts = $user->carts()->get();
            return $carts;
        }
        return 10;
        // return Cart::with('items')
        //     ->withCount('items')
        //     ->where('session_id', \request()->session()->getId())
        //     ->firstOrCreate([
        //         'ip' => request()->ip(),
        //         'session_id' => \request()->session()->getId()
        //     ]);
    }

    public static function addToCart($id, $qty = 1, $force = false)
    {
        $product = Product::find($id);
        if (!$force) {
            $firstItemOnCart = self::getCart()->items()->first();
            if ($firstItemOnCart && !$force) {
                if ($firstItemOnCart->vendor_id != $product->user_id) {
                    return false;
                }
            }
        } else {
            self::getCart()->delete();
        }
        $item = self::getCart()
            ->items()
            ->where(['product_id' => $product->id])
            ->first();
        if ($item) {
            $subtotal = $item->subtotal + ($qty * $product->sell_price);
            $tax = setting('is_tax') ? ($subtotal * setting('tax') / 100) : 0;
            $item->update([
                'qty' => $item->qty + $qty,
                'subtotal' => $subtotal,
                'total' => $subtotal + $tax,
                'tax' => $tax
            ]);
        } else {
            $subtotal = $qty * $product->sell_price;
            $tax = setting('is_tax') ? ($subtotal * setting('tax') / 100) : 0;

            self::getCart()
                ->items()->create([
                    'product_id' => $product->id,
                    'amount' => $product->sell_price,
                    'subtotal' => $subtotal,
                    'qty' => $qty,
                    'total' => $subtotal + $tax,
                    'tax' => $tax,
                    'vendor_id' => $product->user_id
                ]);
            // not here !!
            // Increment sales_count for the product
            //        $product->increment('sales_count', $qty);
        }

        return true;
    }

    public static function checkProductAvailable($id, $qty)
    {
        $product = Product::find($id);
        if (!$product->no_quantity) {
            return $product->available_quantity >= $qty;
        }
        return true;
    }

    public static function decrement($id)
    {
        $item = self::getCart()
            ->items()
            ->where(['id' => $id])
            ->first();
        if ($item->qty > 1) {
            // $item->decrement('qty', 1);
            $subtotal = $item->subtotal - $item->product->sell_price;
            $tax = setting('is_tax') ? ($subtotal * setting('tax') / 100) : 0;

            $item->qty -= 1;
            $item->subtotal = $subtotal;
            $item->tax = $tax;
            $item->total = $subtotal + $tax;
            $item->save();
        } else {
            $item->delete();
        }
    }

    public static function increment($id)
    {
        $item = self::getCart()
            ->items()
            ->where(['id' => $id])
            ->first();
        // $item->increment('qty', 1);
        $subtotal = $item->subtotal + $item->product->sell_price;
        $tax = setting('is_tax') ? ($subtotal * setting('tax') / 100) : 0;

        $item->qty += 1;
        $item->subtotal = $subtotal;
        $item->total = $subtotal + $tax;
        $item->tax = $tax;
        $item->save();
    }

    public static function addSessionCartToAuthUser($user)
    {
        $authUserCart = Cart::whereUserId($user->id)->first();
        $Guest_cart = Cart::where('session_id', \request()->session()->getId())->where('ip', \request()->ip())->first();
        if ($Guest_cart && $authUserCart) {
            if (!$Guest_cart->items->count()) {
                $Guest_cart->delete();
            } else {
                $authUserCart->delete();
                $Guest_cart->update(['user_id' => $user->id]);
            }
        }
    }

    public static function removeFromCart($id)
    {
        self::getCart()->items()->where(['id' => $id])->delete();
    }
}
