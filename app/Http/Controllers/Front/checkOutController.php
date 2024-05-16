<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Product;
use App\Models\Back\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class checkOutController extends Controller
{

    public function index(Request $request)
    {
        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $getAllGeneralInfo = General::get()->first();

        $userSession = session()->get('clientSession', []);
        if (empty($userSession)) {
            $wishlistCount = 0;
            return view('Front.checkout', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
        }
        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();

        $address = Address::where('user_id', $userId)->orderBy('id', 'desc')->first();
        return view('Front.checkout', compact('address','getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
    }




    public function proceedToCheckout(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $userSession = $request->session()->get('clientSession', []);

        if (empty($cart)) {
            return response()->json([
                'status' => 'emptyCart',
                'message' => 'Please add items to the cart to proceed to checkout.',
            ]);
        }

        if (empty($userSession)) {
            return response()->json([
                'status' => 'emptyUserSession',
                'message' => 'Please sign in to proceed to checkout.',
            ]);
        }

        $cartItems = [];

        foreach ($cart as $productId => $item) {
            $product = Product::find($item['id']);
            if (!$product) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Product not found.',
                ]);
            }

            $cartItem = [
                'id' => $item['id'],
                'name' => $product->name,
                'quantity' => $item['quantity'],
                'price' => $product->price,
            ];

            $cartItems[] = $cartItem;

            if ($product->remained_quantity < $item['quantity']) {
                $item['quantity'] = $product->remained_quantity;
                $request->session()->put('cart', $cart);
            }
        }

        $request->session()->put('cartItems', $cartItems);

        return response()->json([
            'status' => 'success',
        ]);
    }
}
