<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use Illuminate\Http\Request;

class ProductsFilter extends Controller
{
    public static function getSizes($subCatId)
    {
        $getSubCatIds = Product::select('id')->whereIn('subCategory_id', $subCatId)->pluck('id');
        return $getSubCatIds;
        $getSubCatIds = Product::select('id')->whereIn('subCategory_id', $subCatId)->pluck('id');
    }
}
