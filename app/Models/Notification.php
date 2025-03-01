<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['title', 'link', 'user_id',  'seen_at'];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function markAsSeen()
    {
        if (!$this->seen_at) {
            $this->seen_at = Carbon::now();
        }
        $this->save();
    }

    public function scopeUnRead($q)
    {
        return $q->whereNull('seen_at');
    }

    public static function send($user_id, $title, $link = null)
    {
        return static::query()->create(compact('user_id', 'title', 'link'));
    }
}
