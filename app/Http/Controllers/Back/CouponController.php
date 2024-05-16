<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\Coupon;
use App\Models\Back\Product;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function index()
    {
        $adminSession = session()->get('adminSession');
        // $clientSession = session()->get('clientSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        // return $adminSession;
        $allCoupons = Coupon::select('*')->with('users')->get();
        $allUsers = User::select('id', 'name')->get();
        $user =
        // Fetch existing user IDs
        $existingUserIds = Coupon::pluck('user_id')->toArray();
        $id = $adminSession['id'];
        $user = User::find($id);
        // return $user;
        return view('Back.coupon', compact('user','allCoupons', 'allUsers', 'existingUserIds'));
    }



    public function show(string $id)
    {
        // return $id;
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        // return $id;
        $coupon = Coupon::find($id);
        $allUsers = User::select('id', 'name')->get();
        $existingUserIds = User::pluck('id')->toArray();
        $id = $adminSession['id'];
        $user = User::find($id);

        return view('Back.coupon_2', compact('coupon', 'allUsers', 'existingUserIds', 'user'));
    }





    public function store(Request $request)
    {
        // return $request;
        $adminSession = session()->get('adminSession');
        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $code = $request->code;
        $discount = $request->discount;
        $isActive = $request->isActive;
        $minPurchaseAmt = $request->minPurchaseAmt;
        $start_date = $request->start_date;
        $expiry_date = $request->expiry_date;
        $user_id = $request->user_id;
        $userUsageCount = 0;
        $usageCount = $request->usageCount;
        $checkValidations = $request->validate([
            'code' => 'required',
            'discount' => 'required',
            'isActive' => 'required',
            'minPurchaseAmt' => 'required',
            'user_id' => 'required',
            'start_date' => 'required',
            'expiry_date' => 'required',

        ]);
        $checkExisting = Coupon::where('code', $code)->exists();
        // return $checkExisting;
        if ($checkExisting) {
            return response()->json([
                'status' => 'error',
                'message' => 'Code Already Exists, Please try again',
                'errors' => [
                    'code' => 'Code Already Exists, Please try again',
                ]
            ]);
        }

        $data = [
            'code' => $code,
            'discountAmount' => $discount,
            'usageCount' => $usageCount,
            'userUsageCount' => $userUsageCount,
            'minimumPurchaseAmount' => $minPurchaseAmt,
            'user_id' => $user_id,
            'isActive' => $isActive,
            'from_date' => $start_date,
            'to_date' => $expiry_date,
        ];
        Coupon::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Coupon Code Added Successfully',
        ]);
    }






    public function update(Request $request, string $id)
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }

        $code = $request->code;
        $discountAmount = $request->discountAmount;
        $expiry_date = $request->to_date;
        $isActive = $request->isActive;
        $minimumPurchaseAmount = $request->minimumPurchaseAmount;
        $start_date = $request->from_date;
        $usageCount = $request->usageCount;
        $user_id = $request->user_id;

        $checkValidations = $request->validate([
            'code' => 'required',
            'discountAmount' => 'required',
            'to_date' => 'required',
            'isActive' => 'required',
            'minimumPurchaseAmount' => 'required',
            'from_date' => 'required',
            'usageCount' => 'required',
            'user_id' => 'required',
        ]);

        $coupons = Coupon::findOrFail($id);

        // Check if the code already exists
        if ($code !== $coupons->code && Coupon::where('code', $code)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Code already exists. Please try again with a different code.',
            ]);
        }

        // Check if the user ID already exists
        if ($user_id !== $coupons->user_id && Coupon::where('user_id', $user_id)->where('id', '!=', $id)->exists()) {
            return response()->json([
                'status' => 'error',
                'message' => 'User already exists. Please select a different user.',
            ]);
        }

        $data = [
            'code' => $code,
            'user_id' => $user_id,
            'discountAmount' => $discountAmount,
            'usageCount' => $usageCount,
            'minimumPurchaseAmount' => $minimumPurchaseAmount,
            'isActive' => $isActive,
            'from_date' => $start_date,
            'to_date' => $expiry_date,
        ];

        $coupons->update($data);

        return response()->json([
            'status' => 'success',
            'message' => 'Coupon Code Updated Successfully',
        ]);
    }




    public function destroy(string $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $deleted = Coupon::where('id', $id)->delete();
        if ($deleted) {
            return response()->json([
                'status' => 'success',
                'message' => 'Coupon Code Deleted successfully',

            ]);
        } else {
            return response()->json([
                'status' => 'error',
                'message' => 'Please Try again',
            ]);
        }
    }
}
