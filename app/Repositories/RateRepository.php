<?php

namespace App\Repositories;

use App\Http\Requests\AddRateRequest;
use App\Interfaces\RateInterface;
use App\Models\Product;
use Illuminate\Http\Request;

class RateRepository implements RateInterface
{

    public function index($product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return false;
        }
        return  $product->user_rates()->get();
    }


    public function addRate($request, $product_id)
    {
        $product = Product::find($product_id);
        if (!$product) {
            return false;
        }
        if (auth('api')->user()->rates()->where('product_id', $product_id)->exists()) {
            auth('api')->user()->rates()->updateExistingPivot($product_id, [
                'rate' => $request->rate,
                'notes' => $request->notes,
            ]);
        } else {
            auth('api')->user()->rates()->attach($product_id, [
                'rate' => $request->rate,
                'notes' => $request->notes,
            ]);
        }
        return true;
    }

    public function removeRate($product_id)
    {

        $product = Product::find($product_id);
        if (!$product) {
            return false;
        }
        auth()->user()->rates()->detach($product_id);
        return true;
    }
}
