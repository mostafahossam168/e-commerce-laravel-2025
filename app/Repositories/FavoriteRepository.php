<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Interfaces\FavoriteInterface;
use App\Models\Product;

class FavoriteRepository  implements FavoriteInterface
{
    public function index()
    {

        $userId = auth('api')->id();
        $query = DB::table('favorites')
            ->where('ip', request()->ip())
            ->where('session_id', request()->session()->getId());
        if ($userId) {
            $query->where('user_id', $userId);
        }
        return $query->get();
    }
    public function addToFavorite($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return false;
        }

        $userId = auth('api')->id();
        $sessionId = request()->session()->getId();
        $ip = request()->ip();
        $item =   DB::table('favorites')
            ->where('product_id', $id)
            ->where('ip', $ip)
            ->where('session_id', $sessionId)
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->first();
        if ($item) {
            return false;
        }

        DB::table('favorites')->insert([
            'user_id' => auth('api')->id() ?? null,
            'session_id' => request()->session()->getId(),
            'ip' => request()->ip(),
            'product_id' => $id,
        ]);
        return true;
    }

    public function removeFromFavorite($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return false;
        }

        $userId = auth('api')->id();
        $sessionId = request()->session()->getId();
        $ip = request()->ip();

        DB::table('favorites')
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
