<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $guarded = [];
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function scopeActive($q)
    {
        return $q->where('status', 1);
    }
    public function scopeInActive($q)
    {
        return $q->where('status', 0);
    }


    public function ScopeUsers($q)
    {
        return $q->where('type', 'user');
    }
    public function ScopeAdmins($q)
    {
        return $q->where('type', 'admin');
    }
    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    public function favorites()
    {
        return $this->belongsToMany(Product::class, 'favorites')->withPivot('session_id', 'ip')->withTimestamps();
    }

    public function carts()
    {
        return $this->belongsToMany(Product::class, 'carts')->withPivot('price', 'qty', 'session_id', 'ip')->withTimestamps();
    }


    public function rates()
    {
        return $this->belongsToMany(Product::class, 'rates')->withPivot('notes', 'rate')->withTimestamps();
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function fcm_tokens()
    {
        return $this->hasMany(FcmToken::class);
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }
    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'status' => Status::class,
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
