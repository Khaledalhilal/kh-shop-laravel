<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Wishlist;
use App\Models\ShippingAddress;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    public function index()
    {
        $getAllCategories = Category::select('id', 'name', 'image')->with('subCategory')->get();
        $getAllGeneralInfo = General::get()->first();
        $userSession = session()->get('clientSession', []);

        if (empty($userSession)) {
            $wishlistCount = 0;
            return view('Front.login', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
        }
        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        return view('Front.login', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
    }
    public function signUp()
    {
        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $getAllGeneralInfo = General::get()->first();
        $userSession = session()->get('clientSession', []);

        if (empty($userSession)) {
            $wishlistCount = 0;
            return view('Front.signUp', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
        }
        $userId = $userSession['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();

        return view('Front.signUp', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
    }








    public function SignUpNewClient(Request $request)
    {
        $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'RepeatPassword' => 'required|min:6',
            'birthDate' => 'required',
            'city' => 'required',
            'country' => 'required',
            'email' => 'required',
            'password' => 'required|min:6',
            'phoneNumber' => 'required|min:8|max:8',
            'state' => 'required',
            'streetNbr' => 'required',
        ]);

        $name = $request->fName . " " . $request->lName;
        $birthdate = $request->birthDate;
        $city = $request->city;
        $country = $request->country;
        $email = $request->email;
        $password = $request->password;
        $RepeatPassword = $request->RepeatPassword;
        $phoneNumber = $request->phoneNumber;
        $state = $request->state;
        $streetNbr = $request->streetNbr;
        $gender = $request->gender;

        if ($request->hasFile('img')) {
            $imageName = $request->file('img')->storeAs('img/profile', "profile.jpg", 'profile-image');
        } else {
            $imageName = "profile.jpg";
        }

        $phoneNbr = User::where('Phone_number', $phoneNumber)->first();
        if ($phoneNbr) {
            return response()->json([
                'status' => 'ExitsPhoneNbr'
            ]);
        }
        if ($password != $RepeatPassword) {
            return response()->json([
                'status' => 'passwordsNotEqual'
            ]);
        }

        $hashedPassword = Hash::make($password);
        $data = [
            'name' => $name,
            'image' => $imageName,
            'email' => $email,
            'password' => $hashedPassword,
            'phone_number' => $phoneNumber,
            'birth_date' => $birthdate,
            'gender' => $gender,
            'user_type' => 'user',
        ];
        $last_user = User::create($data);
        $user_id = $last_user->id;
        $address_data = [
            'user_id' => $user_id,
            'street_number' => $streetNbr,
            'city' => $city,
            'country' => $country,
            'state' => $state,
        ];
        $address = Address::create($address_data);
        return response()->json([
            'status' => 'success',
            'message' => 'Sign Up Successfully',
        ]);
    }



    public function CheckClientSignIn(Request $request)
    {
        $request->validate([
            'phone_number' => 'required',
            'password' => 'required',
        ]);

        $phoneNumber = $request->phone_number;
        $password = $request->password;
        $user = User::where('phone_number', $phoneNumber)->first();

        if (!$user) {
            return response()->json([
                'status' => 'userNotFound',
                'message' => 'Invalid Phone Number !!'
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return response()->json([
                'status' => 'invalidPassword',
                'message' => 'Invalid password.'
            ]);
        }

        // User authenticated successfully
        $id = $user->id;
        $name = $user->name;
        $phone_number = $user->phone_number;

        // Store user data in session
        Session::put('clientSession', [
            'id' => $id,
            'name' => $name,
            'phone_number' => $phone_number,
        ]);

        // Regenerate session ID
        Session::regenerate();
        
        return response()->json([
            'status' => 'success',
            'message' => 'Login successful.',
        ]);
    }




    public function destroyClientSession(string $id)
    {
        Session::forget('clientSession');

        return Redirect::route('home.index');
    }
}
