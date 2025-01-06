<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'status' => OrderStatus::class,
        ];
    }

    public static function generateNextOrderNumber()
    {
        $lastOrder = Order::latest('id')->first();
        if (!$lastOrder) {
            $number = 0;
        } else {
            $number = substr($lastOrder->number, 3);
        }
        return 'ORD' . sprintf('%06d', intval($number) + 1);
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->number = static::generateNextOrderNumber();
        });
    }

    public function  products()
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function  user()
    {
        return $this->belongsTo(User::class);
    }
}
