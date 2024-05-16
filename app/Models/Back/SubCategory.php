<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    use HasFactory;
    protected $fillable = ['category_id', 'name', 'image'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public static function getAllSubCategories()
    {
        return self::with('category')->select('id', 'name', 'image')->get();
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
    // public function productss()
    // {
    //     return self ::with('products')->get();
    // }
    public static function allSubCategories(){
        return self::select('id','name','image')->get();
    }
}
