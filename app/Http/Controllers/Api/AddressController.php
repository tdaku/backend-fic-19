<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AddressesBuyer;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        $addresses = $request->user()->addresses;

        return response()->json([
            'status' => 'success',
            'message' => 'Address successfully',
            'data' => $addresses,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([

            'address'=> 'required|string',
            'country' => 'required|string',
            'province'=> 'required|string',
            'city'=> 'required|string',
            'district'=> 'required|string',
            'postal_code'=> 'required|string',
            'is_default'=> 'required|boolean'
        ]);

        $address = AddressesBuyer::create([
            'user_id' => $request->user()->id,
            'address' => $request->address,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'postal_code' => $request->postal_code,
            'is_default' => $request->is_default,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Address created successfully',
            'data' => $address,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'address'=> 'required|string',
            'country' => 'required|string',
            'province'=> 'required|string',
            'city'=> 'required|string',
            'district'=> 'required|string',
            'postal_code'=> 'required|string',
            'is_default'=> 'required|boolean'
        ]);

        $address = AddressesBuyer::find($id);
        $address->update([
            'address' => $request->address,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'district' => $request->district,
            'postal_code' => $request->postal_code,
            'is_default' => $request->is_default,
        ]);

        return response()->json([
            'status' => "success",
            'message' => "Address updated successfully",
            'data' => $address,
        ], 200);
    }

    public function destroy($id){

        $address = AddressesBuyer::find($id);
        $address->delete();

        return response()->json([
            'status' => "success",
            'message' => "Address deleted successfully",
        ], 200);
    }

}
