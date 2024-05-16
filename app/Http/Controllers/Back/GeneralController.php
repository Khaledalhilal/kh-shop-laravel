<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Back\General;
use App\Models\User;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function index()
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $getAllInfo = General::get()->all();
        $id = $adminSession['id'];
        $user = User::find($id);
        return view('Back.general', compact('getAllInfo','user'));
    }


    public function updateLandingImage(Request $request, $id)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $landing = General::findOrFail(1);
        $validator = $request->validate([
            'updateImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('updateImage')) {
            $imageName = 'landing_' . time() . '.' . $request->file('updateImage')->extension();
            $request->file('updateImage')->storeAs('Back/img/landingImage', $imageName, 'back-img-landing');
            $data  = ['landing_image' => $imageName,];
            $landing->update($data);
            return response()->json(['status' => '1']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'oops']);
        }
    }

    public function updateContactInfo(Request $request)
    {

        $adminSession = session()->get('adminSession');

        if (!$adminSession) {
            return redirect()->route('admin.index');
        }
        $validator = $request->validate([
            'phoneNumber' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);
        $data = [
            'email' => $request->email,
            'phone_number' => $request->phoneNumber,
            'address' => $request->address,
        ];
        $landing = General::findOrFail(1);
        $landing->update($data);

        return response()->json([
            'status' => '1',
        ]);
    }
}
