<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Back\Product;
use App\Models\Back\Stock;
use App\Models\Common\Order;
use App\Models\Common\OrderItems;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    public function index()
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }


        $orders = Order::with('users', 'order_items', 'order_items.product')
            ->orderBy('id', 'desc')
            ->get();


        $id = $adminSession['id'];
        $user = User::find($id);

        return view('Back.orders.order', compact('orders', 'user'));
    }




    public function orderAddress(string $id)
    {
        // return $id;
        $adminSession = session()->get('adminSession');
        if (!$adminSession) {
            return redirect()->route('admin.index');
        }


        $allOrders = OrderItems::with('order', 'product', 'order.users', 'order.order_address')
            ->whereHas('order', function ($query) use ($id) {
                $query->where('order_id', $id);
            })
            ->get();
        // return $allOrders;


        $id = $adminSession['id'];
        $user = User::find($id);

        // return $allOrders;


        return view('Back.orders.order_address', compact('allOrders', 'user'));
    }

    public function store(Request $request)
    {
        $current_date = date('Y-m-d H:i:s'); // Format: YYYY-MM-DD HH:MM:SS

        $Client_session = session()->get('clientSession', []);
        $user_id = $Client_session['id'];
        $cart = session()->get('cart', []);
        $address = Address::where('user_id', $user_id)
            ->orderBy('id', 'desc')->first();
        $coupon = session()->get('coupon', []);
        $discount = array_values($coupon)[0]['discount'] ?? 0;
        $order = Order::create([
            'user_id' => $user_id,
            'address_id' => $address->id,
            'couponDiscount' => $discount,
            'date' => $current_date,
        ]);

        foreach (session()->get('cart', []) as $key => $cart) {
            $product_id = $cart['id'];
            $color = $cart['color'];
            $size = $cart['size'];
            $price = $cart['price'];
            $quantity = $cart['quantity'];
            $order_id = $order->id;
            $data = [
                'order_id' => $order_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'country' => $address->country,
                'state' => $address->state,
                'city' => $address->city,
                'price' => $price,
                'size' => $size,
                'color' => $color,
            ];


            $order_items = OrderItems::create($data);
            $remained_quantity = Product::where('id', $product_id)->first();

            if ($remained_quantity) {
                $remained_quantity->decrement('remained_quantity', $quantity);
            }
        }
        session()->forget('cart');
        session()->forget('cartCounter');
        session()->forget('coupon');
        return response()->json([
            'status' => 'success',
            'message' => 'Thank You For Your Order',

        ]);
    }


    public function show(string $id)
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $allOrders = Order::with('order_items', 'order_address', 'users', 'order_items.product')->where('address_id', $id)->get();
        $id = $adminSession['id'];
        $user = User::find($id);
        // return $allOrders;
        return view('Back.orders.details1', compact('allOrders', 'user'));
    }




    public function updateOrderStatus(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'new_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first(), // Return the first validation error message
            ]);
        }

        $order = Order::findOrFail($id);
        $newStatus = $request->new_status;
        $order->status = $newStatus;
        $order->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Status updated successfully'
        ]);
    }
}
