<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Product;
use App\Models\Back\Wishlist;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index()
    {
        $noResultsFound = false;
        $getAllGeneralInfo = General::first();

        $getAllCategories = Category::whereHas('products', function ($query) {
            $query->where('remained_quantity', '>', 0);
        })->with('subCategory')
        ->orderBy('id','desc')->get();



        $recentProducts = Product::select('products.id', 'products.brand_id', 'products.name', 'products.price')
            ->with('imagesForHome', 'brand')
            ->groupBy('products.id', 'products.brand_id', 'products.name', 'products.price')
            ->havingRaw('SUM(remained_quantity) > 0')
            ->take(12)
            ->orderBy('products.id','desc')
            ->get();

        $featuredProducts = Product::with('images', 'brand')
            ->select('products.id', 'products.name', 'products.price', 'products.description', 'products.brand_id')
            ->where('is_featured', 1)
            ->orderBy('products.id', 'desc')
            ->where('remained_quantity', '>', 0)
            ->get();




        $getAllCategories = Category::has('products')->with('subCategory')->get();

        $category = Category::with('subCategory')->where('name', "Women's Clothing")
        ->first();
        $cat_id = $category->id;

        $womensProduct = collect([]);
        foreach ($category->subCategory as $subCategory) {
            $products = Product::where('subCategory_id', $subCategory->id)
            ->where('remained_quantity', '>', 0)
            ->with('images', 'brand', 'sizes', 'colors')
            ->get();
            $womensProduct = $womensProduct->concat($products);
        }
        $category = Category::with('subCategory')->where('name', "men's Clothing")->first();
        $cat_id = $category->id;

        $mensProduct = collect([]);
        foreach ($category->subCategory as $subCategory) {
            $products = Product::where('subCategory_id', $subCategory->id)
            ->where('remained_quantity', '>', 0)
            ->with('images', 'brand', 'sizes', 'colors')
            ->get();
            $mensProduct = $mensProduct->concat($products);
        }



        $userSession = session()->get('clientSession', []);
        if (!$userSession) {
            $wishlistCount = 0;
            return view('Front.index', compact('noResultsFound', 'getAllCategories', 'recentProducts', 'featuredProducts', 'getAllGeneralInfo', 'mensProduct', 'womensProduct', 'wishlistCount'));
        }
        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        if (empty($userSession)) {
            $wishlistCount = 0;
        }


        return view('Front.index', compact('noResultsFound', 'getAllCategories', 'recentProducts', 'featuredProducts', 'getAllGeneralInfo', 'mensProduct', 'womensProduct', 'wishlistCount'));
    }
}
