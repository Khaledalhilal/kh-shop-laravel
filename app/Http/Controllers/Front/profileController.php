<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Back\Category;
use App\Models\Back\General;
use App\Models\Back\Wishlist;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class profileController extends Controller
{


    public function index()
    {
        $getAllCategories = Category::has('products')->with('subCategory')->get();
        $getAllGeneralInfo = General::get()->first();
        $user = session()->get('clientSession', []);
        $userId = $user['id'];
        $wishlistCount = Wishlist::where('user_id', $userId)->count();
        if (!$user) {
            $wishlistCount = 0;
            return view('Front.index', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount'));
        }
        $user_id = $user['id'];
        $user = User::find($user_id);

        return view('Front.profile', compact('getAllCategories', 'getAllGeneralInfo', 'wishlistCount', 'user'));
    }
    public function adminProfile()
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.profile', compact("user"));
    }


    public function getAdminPassword()
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.changePassword', compact("user"));
    }



    public function update(Request $request)
    {

        $fName = $request->fName;
        $lName = $request->lName;
        $image = $request->img;
        $gender = $request->gender;
        $email = $request->email;
        $phoneNumber = $request->phoneNumber;
        $birthDate = $request->birthDate;
        $oldPass = $request->oldPass;
        $newPass = $request->newPass;
        $repeatNewPass = $request->repeatNewPass;

        $validator = $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required|min:8 | max:8',
            'birthDate' => 'required',
            'gender' => 'required',
        ]);
        // Check if the phone number already exists
        // $existingUser = User::where('phone_number', $phoneNumber)
        //     ->where('id', '!=', auth()->id())
        //     ->exists();
        // if ($existingUser) {
        //     return response()->json([
        //         'status' => 'existsPhoneNbr',
        //         'message' => 'Phone number already exists.',
        //     ]);
        // }

        if (!empty($image)) {
            $user = session()->get('clientSession', []);
            $userId = $user['id'];
            $users = User::find($userId);
            $imageName = $fName . '_' . $lName . "_" . time() . '.' . $request->file('img')->extension();
            $request->file('img')->storeAs('img/profile', $imageName, 'profile-image');
            $users->update([
                'image' => $imageName,
            ]);
        }
        if (!empty($oldPass)) {
            if (!empty($newPass) || !empty($repeatNewPass)) {
                $user = session()->get('clientSession', []);
                $userId = $user['id'];
                $user = User::find($userId);
                if (!Hash::check($oldPass, $user->password)) {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid password. Try again!'
                    ]);
                }
                if ($newPass !== $repeatNewPass) {
                    return response()->json([
                        "status" => "error",
                        "message" => "New password and repeated new password do not match.",
                    ]);
                } else {




                    $getAllCategories = Category::has('products')->with('subCategory')->get();
                    $getAllGeneralInfo = General::get()->first();

                    $wishlistCount = Wishlist::where('user_id', $userId)->count();

                    $user_id = $user['id'];
                    $user = User::find($user_id);
                    $hashedPassword = Hash::make($newPass);
                    $data = [
                        'name' => $fName . " " . $lName,
                        'Gender' => $gender,
                        'password' => $hashedPassword,
                        'email' => $email,
                        'phone_number' => $phoneNumber,
                        'birth_date' => $birthDate,
                    ];
                    $user->update($data);
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Your Profile updated successfully',
                    ]);
                }
            } else {
                return response()->json([
                    "status" => "error",
                    "message" => "Please Fill password and repeat pass",
                ]);
            }
        } else {
            $user = session()->get('clientSession', []);
            $userId = $user['id'];
            $user = User::find($userId);

            if (!empty($oldPass) & empty($newPass)) {
                return response()->json([
                    "error" => "error",
                    "message" => "Please try again",
                ]);
            }

            $getAllCategories = Category::has('products')->with('subCategory')->get();
            $getAllGeneralInfo = General::get()->first();

            $wishlistCount = Wishlist::where('user_id', $userId)->count();

            $user_id = $user['id'];
            $user = User::find($user_id);

            $data = [
                'name' => $fName . " " . $lName,
                'Gender' => $gender,
                'email' => $email,
                'phone_number' => $phoneNumber,
                'birth_date' => $birthDate,
            ];
            $user->update($data);
            return response()->json([
                'status' => 'success',
                'message' => 'Your Profile updated successfully',
            ]);
        }
    }


    public function updateAdminProfile(Request $request)
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $fName = $request->fName;
        $lName = $request->lName;
        $image = $request->img;
        $gender = $request->gender;
        $email = $request->email;
        $phoneNumber = $request->phoneNumber;
        $birthDate = $request->birthDate;


        $validator = $request->validate([
            'fName' => 'required',
            'lName' => 'required',
            'email' => 'required',
            'phoneNumber' => 'required|min:8 | max:8',
            'birthDate' => 'required',
            'gender' => 'required',
        ]);


        if (!empty($image)) {
            $user = session()->get('adminSession', []);
            $userId = $user['id'];
            $users = User::find($userId);
            $imageName = $fName . '_' . $lName . "_" . time() . '.' . $request->file('img')->extension();
            $request->file('img')->storeAs('img/profile', $imageName, 'profile-image');
            $users->update([
                'image' => $imageName,
            ]);
        }


        $user = session()->get('adminSession', []);
        $userId = $user['id'];
        $user = User::find($userId);


        $data = [
            'name' => $fName . " " . $lName,
            'Gender' => $gender,
            'email' => $email,
            'phone_number' => $phoneNumber,
            'birth_date' => $birthDate,
        ];
        $user->update($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Your Profile updated successfully',
        ]);
    }




























    public function changeAdminPassword(Request $request)
    {
        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $oldPass = $request->oldPass;
        $newPass = $request->newPass;
        $repeatNewPass = $request->repeatNewPass;


        $validator = $request->validate([
            'oldPass' => 'required',
            'newPass' => 'required',
            'repeatNewPass' => 'required',
        ]);

        $userId = $adminSession['id'];
        $user = User::find($userId);
        if (!Hash::check($oldPass, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid password.'
            ]);
        }
        if ($newPass != $repeatNewPass) {
            return response()->json([
                'status' => 'error',
                'message' => 'Passwords Should Be Same!!'
            ]);
        }
        $hashedPassword = Hash::make($newPass);
        $user->update([
            'password'=>$hashedPassword,
        ]);
        return response()->json([
            'status' => 'success',
            'message' => 'Password updated Successfully'
        ]);
        return $user;
    }
}
