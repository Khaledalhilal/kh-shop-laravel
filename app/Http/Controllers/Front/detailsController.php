<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Product;
use App\Models\Back\Wishlist;
use Illuminate\Http\Request;

class detailsController extends Controller
{





    public function showDetailsByProduct(string $id)
    {
        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $specificProduct = Product::with('images', 'brand', 'colors','sizes')->find($id);
      
        $getAllGeneralInfo = General::get()->first();
        if (empty($userSession)) {
            $wishlistCount = 0;
            return view('Front.detail', compact('getAllCategories', 'specificProduct', 'getAllGeneralInfo', 'wishlistCount'));

        }
        $userSession = session()->get('clientSession', []);
        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();

        return view('Front.detail', compact('getAllCategories', 'specificProduct', 'getAllGeneralInfo', 'wishlistCount'));
    }
}
