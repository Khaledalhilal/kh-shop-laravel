<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'colors';
    protected $fillable = [
        'id', 'product_id', 'color',
    ];


    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
