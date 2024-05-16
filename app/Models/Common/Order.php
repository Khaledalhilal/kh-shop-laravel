<?php

namespace App\Models\Common;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'address_id',
        'date',
        'status',
        'couponDiscount',
        'created_at',
        'updated_at',
    ];
    protected $table = 'orders';

    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }
    public function order_address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
