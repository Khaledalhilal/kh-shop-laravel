<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table = 'sizes';
    protected $fillable = [
        'id', 'product_id', 'size',
    ];

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
