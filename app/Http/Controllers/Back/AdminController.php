<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class AdminController extends Controller
{
    public function index()
    {
        return view('Back.login');
    }

    public function CheckAdminSignIn(Request $request)
    {

        $request->validate([
            'phoneNumber' => 'required',
            'password' => 'required',
        ]);

        $phoneNumber = $request->phoneNumber;
        $password = $request->password;
        $admin = User::where('phone_number', $phoneNumber)->first();


        if (!$admin) {
            return response()->json([
                'status' => 'invalidPhoneNbr',
                'message' => 'Invalid Phone Number !!'
            ]);
        }
        $id = $admin->id;
        $name = $admin->name;
        $phone_number = $admin->phone_number;

        if (!Hash::check($password, $admin->password)) {
            return response()->json([
                'status' => 'invalidPassword',
                'message' => 'Invalid password.'
            ]);
        }
        if ($admin->user_type === 'admin') {
            Session::put('adminSession', [
                'id' => $id,
                'name' => $name,
                'phone_number' => $phone_number,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Login successful.',

            ]);
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Some Thing Went Wrong, Try Again !!',

        ]);
    }



    public function destroyAdminSession(string $id)
    {
        Session::forget('adminSession');
        $adminSession = session()->get('adminSession');

        return Redirect::route('admin.index');
    }
}
