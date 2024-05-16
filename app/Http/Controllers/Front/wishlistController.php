<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Wishlist;
use Illuminate\Http\Request;

class wishlistController extends Controller
{

    public function index()
    {


        $getAllGeneralInfo = General::get()->first();
        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $userSession = session()->get('clientSession', []);
        if (empty($userSession)) {
            $wishlistCount = 0;
            return view('Front.login', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
        }



        //! Retrieve wishlists for the specific user
        $userId = $userSession['id'];
        $allWishlists = Wishlist::where('user_id', $userId)->with('products')->get();
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        return view('Front.wishlist', compact('getAllCategories', 'getAllGeneralInfo', 'allWishlists', 'wishlistCount'));
    }

    public function store(Request $request)
    {


        $userSession = $request->session()->get('clientSession', []);

        if (empty($userSession)) {
            return response()->json([
                'status' => 'emptyUserSession',
                'message' => 'You should Sign in First, To add to wish list!!',
            ]);
        }
        $product_id = $request->productId;

        $data = [
            'product_id' => $product_id,
            'user_id' => $userSession['id'],
        ];

        $existingProd = Wishlist::where('product_id', $product_id)->first();
        if ($existingProd) {

            return response()->json([
                'status' => 'error',
                'message' => 'product already exists in Your Wishlist !!',
            ]);
        }
        Wishlist::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'product Added successfully',
        ]);
    }


    public function destroy(string $id)
    {

        $deleted = Wishlist::where('id', $id)->delete();
        if ($deleted) {
            return response()->json([
                'status' => 'success',
            ]);
        }
    }
}
