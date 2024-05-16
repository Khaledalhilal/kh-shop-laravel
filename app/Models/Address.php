<?php

namespace App\Models;

use App\Models\Common\Order;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    protected $table = 'shippingaddress';
    protected $fillable = [
        'id',
        'user_id',
        'country',
        'state',
        'city',
        'street_number',
        'created_at',
        'updated_at',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
