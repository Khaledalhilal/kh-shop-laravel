<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\Coupon;
use App\Models\Back\General;
use App\Models\Back\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class getCoupon extends Controller
{
    public function CheckCoupon(Request $request)
    {
        $price = str_replace('$', '', $request->price);
        //! check if user login or not:
        $clientSession = session()->get('clientSession');
        if (!$clientSession) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please Sign In First!!'
            ]);
        }
        $user_id = $clientSession['id'];
        //! Validate if request is empty
        if (!$request->has('name') || empty($request->name)) {
            return response()->json([
                'status' => 'emptyInput',
                'message' => 'Please enter a coupon code!'
            ]);
        }
        if (!$request->has('name') || empty($request->name)) {
            return response()->json([
                'status' => 'emptyInput',
                'message' => 'Please enter a coupon code!'
            ]);
        }


        $couponResult = Coupon::where('code', $request->name)
            ->whereHas('users', function ($query) use ($user_id) {
                $query->where('id', $user_id);
            })
            ->first();
        //! If no coupon found, return not found response
        if (!$couponResult) {
            return response()->json([
                'status' => 'notFound',
                'message' => 'Oops! Wrong Coupon Code'
            ]);
        }
        $usageCount = $couponResult->usageCount;

        //! check purchase amount:
        if ($couponResult->minimumPurchaseAmount > $price) {
            return response()->json([
                'status' => 'error',
                'message' => 'You should Purchase at least $' . $couponResult->minimumPurchaseAmount,
            ]);
        }

        //! Check  usage count
        $usageCount = $couponResult->usageCount;
        $userUsageCount = $couponResult->userUsageCount;
        $isActive = $couponResult->isActive;
        $startDate = $couponResult->from_date;
        $expiryDate = $couponResult->to_date;
        $discount_amount = $couponResult->discountAmount;
        if ($usageCount <= $userUsageCount) {
            return response()->json([
                'status' => 'finishLimit',
                'message' => 'Oops! Limit has been reached for this coupon'
            ]);
        }
        // ! Check if is active or not:
        if ($isActive == 'no') {
            return response()->json([
                'status' => 'error',
                'message' => 'Your coupon in not active now!!'
            ]);
        }

        //! Check if today is within the validity period
        $today = Carbon::now()->toDateString();
        $startDate = $couponResult->from_date;
        $expiryDate = $couponResult->to_date;
        if ($today < $startDate || $today > $expiryDate) {
            return response()->json([
                'status' => 'error',
                'message' => 'Your coupon is not valid now!!'
            ]);
        }

        $userUsageCount++;
        $couponResult->update([
            'userUsageCount' => $userUsageCount,
        ]);


        $coupon['coupon_discount'] = [
            'discount' => $discount_amount,
        ];
        $request->session()->put('coupon', $coupon);

        $couponResult->save();
        return response()->json([
            'status' => 'success',
            'discount' => $discount_amount,
        ]);
    }
    public function show()
    {
        $getAllCategories = Category::has('products')->with('subCategory')->get();

        // $getAllCategories = Category::select('id', 'name', 'image')->with('subCategory')->get();
        $getAllGeneralInfo = General::get()->first();
        //! check if user login or not:
        $clientSession = session()->get('clientSession');
        $userId = $clientSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        if (!$clientSession) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please Sign In First!!'
            ]);
        }
        $user_id = $clientSession['id'];


        $allCoupons = Coupon::with('users')->where('user_id',$user_id)->first();
        // return $allCoupons;

        // $allCoupons = Coupon::whereHas('users', function ($query) use ($user_id) {
        //     $query->where('id', $user_id);
        // })
        //     ->first();
        // return $allCoupons;
        $userSession = session()->get('clientSession', []);
        if (empty($userSession)) {
            $wishlistCount = 0;
        }
        return view('Front.coupon', compact('allCoupons', 'getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
    }
}
