<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = [];


    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }
    public function  products()
    {
        return $this->hasMany(Product::class);
    }


    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
    public function scopeInActive($q)
    {
        return $q->where('status', 0);
    }
}
