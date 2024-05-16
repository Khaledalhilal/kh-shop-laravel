<?php

namespace App\Models\Common;

use App\Models\Back\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'order_id',
        'product_id',
        'quantity',
        'country',
        'state',
        'city',
        'size',
        'color',
        'created_at',
        'updated_at',
    ];
    protected $table = 'order_items';

    public function order()
    {
        return $this->belongsTo(Order::class,'order_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }

}
