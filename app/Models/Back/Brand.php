<?php

namespace App\Models\Back;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Laravel\Prompts\select;

class Brand extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'name'];
    
    public static function getAllBrands()
    {
        return self::select('id', 'name')->get();
    }
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
