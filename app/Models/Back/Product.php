<?php

namespace App\Models\Back;

use App\Models\Common\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'subCategory_id',
        'name',
        'gender',
        'description',
        'is_featured',
        'price',
        'quantity',
        'remained_quantity',
    ];
    public function products(): HasMany
    {
        return $this->hasMany(Wishlist::class);
    }


    public function sizes(): HasMany
    {
        return $this->hasMany(Size::class);
    }


    public function colors(): HasMany
    {
        return $this->hasMany(Color::class);
    }


    public function order_items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function category()
    {
        return $this->belongsTo(category::class);
    }


    public function subCategory(): BelongsTo
    {
        return $this->belongsTo(SubCategory::class, 'subCategory_id');
    }

    public function subCategories()
    {
        return $this->belongsTo(SubCategory::class);
    }



    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    public function images()
    {
        return $this->hasMany(product_Image::class);
    }


    public function imagesForHome()
    {
        return $this->hasMany(product_Image::class, 'product_id', 'id')->select('id', 'product_id', 'image');
    }


    public function coupons()
    {
        return $this->hasMany(Coupon::class)->select('id', 'name')->get();
    }


    public function stock()
    {
        return $this->hasMany(stock::class, 'product_id', 'id');
    }
}
