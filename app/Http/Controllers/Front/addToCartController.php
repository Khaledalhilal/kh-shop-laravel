<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Product;
use App\Models\Back\Stock;
use Illuminate\Http\Request;

class addToCartController extends Controller
{

    public function addToCart(Request $request)
    {

        $productId = $request->productId;
        $productName = $request->productName;
        $productPrice = $request->productPrice;
        $size = $request->size;
        $quantity = $request->quantity;
        $color = $request->color;
        $remained_qty = Product::find($productId);
        $cart = $request->session()->get('cart', []);
        if ($remained_qty->remained_quantity < $quantity) {
            return response()->json([
                'status' => 'quantityExceed',
                'message' => 'Only ' . $remained_qty->remained_quantity . ' available in stock.',
            ]);
        }
        if (array_key_exists('product_' . $productId, $cart)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product Already Exists!',
            ]);
        } else {
            $cartCounter = $request->session()->get('cartCounter', 0);

            $cartCounter++;

            $cart['product_' . $productId] = [
                'id' => $productId,
                'name' => $productName,
                'color' => $color,
                'size' => $size,
                'price' => $productPrice,
                'quantity' => $quantity,
            ];

            $request->session()->put('cart', $cart);
            $request->session()->put('cartCounter', $cartCounter);
            return response()->json([
                'status' => 'success',
                'message' => 'Product Added Successfully',
                'cartCounter' => $cartCounter,
            ]);
        }
    }

    public function updateCart(Request $request)
    {
        $productId = $request->productId;
        $productName = $request->productName;
        $productPrice = $request->productPrice;
        $size = $request->size;
        $quantity = $request->quantity;
        $color = $request->color;

        $cart = $request->session()->get('cart', []);

        if (array_key_exists('product_' . $productId, $cart)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Product Already Exists!',
            ]);
        } else {
            $cartCounter = $request->session()->get('cartCounter', 0);
            $cartCounter++;

            $cart['product_' . $productId] = [
                'id' => $productId,
                'name' => $productName,
                'color' => $color,
                'size' => $size,
                'price' => $productPrice,
                'quantity' => $quantity,
            ];

            $request->session()->put('cart', $cart);
            $request->session()->put('cartCounter', $cartCounter);
            return response()->json([
                'status' => 'success',
                'message' => 'Product Added Successfully',
                'cartCounter' => $cartCounter,
            ]);
        }
    }

    
}
