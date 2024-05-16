<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Product;
use App\Models\Back\Wishlist;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $getAllCategories = Category::has('products')->with('subCategory')->get();

        $getAllGeneralInfo = General::get()->first();
        $userSession = session()->get('clientSession', []);
        if (empty($userSession)) {
            $wishlistCount = 0;
            return view('Front.cart', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));

        }
        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        return view('Front.cart', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
    }

    public function update(Request $request)
    {
        $productId = $request->product_id;
        $quantity = $request->quantity;
        $allProduct = Product::find($productId);
        $remained_quantity = $allProduct->remained_quantity;

        if ($remained_quantity < $quantity) {
            return response()->json([
                'status' => 'quantityExceed',
                'message' => 'Only Available ' . $remained_quantity . ' items',
            ]);
        }

        $cart = $request->session()->get('cart', []);

        if (array_key_exists('product_' . $productId, $cart)) {
            $cartItem = $cart['product_' . $productId];

            $cartItem['quantity'] = $quantity;

            $cart['product_' . $productId] = $cartItem;

            $request->session()->put('cart', $cart);

            return response()->json([
                'status' => 'success',
                'message' => 'Quantity updated successfully',
            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Product not found in the cart',
            ]);
        }
    }



    public function deleteFromCart(Request $request)
    {
        $prod_id = $request->id;
        $cartData = $request->session()->get('cart', []);

        if (isset($cartData["product_$prod_id"])) {
            $cartCounter = $request->session()->get('cartCounter', 0);
            $cartCounter--;

            $request->session()->forget("cart.product_$prod_id");

            $request->session()->put('cartCounter', $cartCounter);

            return response()->json([
                'status' => '1',
            ]);
        } else {
            return response()->json([
                'status' => '0',
                'message' => 'Product not found in the cart',
            ], 404);
        }
    }
}
