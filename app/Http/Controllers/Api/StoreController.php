<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\User;


class StoreController extends Controller
{
    public function index(Request $request){

        $stores = User::where('roles', 'seller')->get();
        return response()->json([
            'status' => 'success',
            'message' => 'list stores',
            'data' => $stores,
        ],200);
    }

    public function productByStore(Request $request, $id){

        $products = Product::where('seller_id', $id)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'list products by store',
            'data' => $products,
        ],200);

    }

    //live streaming
    public function liveStreaming(Request $request){

        $stores= User::where('roles','seller')->where('is_livestreaming', true)->get();
        return response()->json([
            'status' => 'success',
            'message' => 'List Store Live Streaming',
            'data' => $stores,
        ],200);


    }
}
