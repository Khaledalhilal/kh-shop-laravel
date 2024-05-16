<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\cr;
use Illuminate\Http\Request;

class AddressController extends Controller
{



    public function update(Request $request, string $id)
    {
        $clientSession = session()->get('clientSession');
        if (!$clientSession) {
            return response()->json([
                'status' => 'error',
                'message' => 'Please Sign In First!!'
            ]);
        }
        $user_id = $clientSession['id'];
        $city = $request->city;
        $country = $request->country;
        $state = $request->state;
        $street_number = $request->street_number;
        $checkValidations = $request->validate([
            'street_number' => 'required',
            'country' => 'required',
            'state' => 'required',
            'city' => 'required',
        ]);
        $data = [
            'user_id' => $user_id,
            'city' => $city,
            'country' => $country,
            'state' => $state,
            'street_number' => $street_number,
        ];
        Address::create($data);
        return response()->json([
            'status' => 'success',
        ]);
    }
}
