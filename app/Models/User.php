<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Back\Coupon;
use App\Models\Back\Wishlist;
use App\Models\Common\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'id',
        'name',
        'email',
        'state',
        'image',
        'password',
        'user_type',
        'phone_number',
        'Gender',
        'birth_date',
        'created_at',
        'updated_at',
    ];
    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function orders()
    {
        return $this->belongsTo(Order::class, 'user_id');
    }

    public function coupons()
    {
        return $this->hasMany(Coupon::class)->select('id', 'name')->get();
    }
}
