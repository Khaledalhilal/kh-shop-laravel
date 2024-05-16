<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name','image'];

    public function subCategory(): HasMany
    {
        return $this->hasMany(subCategory::class);
    }

    // public static function getAllCategories()
    // {
    //     return self::select('id', 'name', 'image')->take(100)->get();
    // }
    public static function getAllCategories()
    {
        // $categories = [];

        // self::select('id', 'name', 'image')->chunk(100, function ($items) use (&$categories) {
        //     foreach ($items as $item) {
        //         $categories[] = $item;
        //     }
        // });
        $categories = Category::get()->all();

        return $categories;
    }
    public function products()
    {
        return $this->hasManyThrough(
            Product::class,
            SubCategory::class,
            'category_id',
            'subCategory_id', // Foreign key on Product table
            'id', // Local key on Category table
            'id' // Local key on SubCategory table
        );
    }
}
