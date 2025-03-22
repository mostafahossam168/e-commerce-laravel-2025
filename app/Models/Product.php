<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded = [];
    protected function casts(): array
    {
        return [
            'status' => Status::class,
        ];
    }

    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
    public function scopeInActive($q)
    {
        return $q->where('status', 0);
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function user_favorites()
    {
        return $this->belongsToMany(User::class, 'favorites')->withPivot('session_id', 'ip')->withTimestamps();
    }

    public function user_carts()
    {
        return $this->belongsToMany(User::class, 'carts')->withPivot('price', 'qty', 'session_id', 'ip')->withTimestamps();
    }
    public function user_rates()
    {
        return $this->belongsToMany(User::class, 'rates')->withPivot('notes', 'rate')->withTimestamps();
    }
}
