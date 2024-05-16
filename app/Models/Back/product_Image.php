<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product_Image extends Model
{
    use HasFactory;
    protected $table = 'product_images';

    protected $fillable =
    [
        'product_id',
        'image',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    public function allImages()
    {
        return product_Image::get()->all();
    }
}
