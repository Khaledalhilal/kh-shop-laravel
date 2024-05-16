<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;


    protected $fillable = [
        'product_id',
        'quantity',
    ];
    public function products()
    {
        return $this->belongsTo(Brand::class);
    }
}
