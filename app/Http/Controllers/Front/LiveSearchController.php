<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Product;
use App\Models\Back\Wishlist;
use Illuminate\Http\Request;

class LiveSearchController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;
        $counter = 0;
        $getAllGeneralInfo = General::first();
        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $allProducts = Product::with('images')->where('name', $search)->where('remained_quantity', '>', 0)
            ->paginate(12);
        $userSession = session()->get('clientSession', []);
        $shopProductHTML = '';

        if (!$allProducts->isEmpty()) {
            $counter++;
        }

        $wishlistCount = 0;
        if ($userSession) {
            $userId = $userSession['id'];
            $wishlistCount = Wishlist::where('user_id', $userId)->count();
        }

        return view('front.liveSearch', compact('counter', 'getAllGeneralInfo', 'getAllCategories', 'wishlistCount', 'allProducts'));
    }


    // public function index(Request $request)
    // {
    //     $search = $request->search;
    //     // return $search;
    //     $getAllGeneralInfo = General::first();
    //     $getAllCategories = Category::has('products')->with('subCategory')->get();
    //     $allProducts = Product::with('images')->where('name', $search)->where('remained_quantity', '>', 0)
    //         ->paginate(12);
    //     $userSession = session()->get('clientSession', []);
    //     $shopProductHTML = '';

    //     if ($allProducts->isEmpty()) {
    //         $shopProductHTML = '<div class="col-12"><h1>No products found.</h1></div>';
    //     } else {
    //         // Render products if found
    //         foreach ($allProducts as $product) {
    //             $shopProductHTML .= '<div class="col-lg-3 col-md-6 col-sm-6 pb-1">
    //             <div class="product-item bg-light mb-4">
    //                 <div class="product-img position-relative overflow-hidden">
    //                     <a href="' . route('detailsByProduct', $product->id) . '">
    //                         <img class="img-fluid" src="' . asset('Back/img/product/' . $product->images->first()->image) . '" style="width: 100% !important; height: 200px !important;">
    //                     </a>
    //                 </div>
    //                 <div class="text-center py-4">
    //                     <a class="h6 text-decoration-none text-truncate" href="">' . $product->name . '</a>
    //                     <div class="d-flex align-items-center justify-content-center mt-2">
    //                         <h5>${{ $product->price }}</h5>
    //                     </div>
    //                 </div>
    //             </div>
    //         </div>';
    //         }
    //     }

    //     // If user session is not available, set wishlist count to 0
    //     $wishlistCount = 0;
    //     if ($userSession) {
    //         $userId = $userSession['id'];
    //         $wishlistCount = Wishlist::where('user_id', $userId)->count();
    //     }

    //     return view('front.liveSearch', compact('shopProductHTML', 'getAllGeneralInfo', 'getAllCategories', 'wishlistCount', 'allProducts'));
    // }
}
