<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Register Seller
Route::post('register/seller',[App\Http\Controllers\Api\AuthController::class, 'registerSeller']);

//Login Seller
Route::post('login',[App\Http\Controllers\Api\AuthController::class, 'login']);

//Logout
Route::post('logout',[App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//Register Buyer
Route::post('register/buyer',[App\Http\Controllers\Api\AuthController::class, 'registerBuyer']);

//Store Category (Seller)
Route::post('seller/category',[App\Http\Controllers\Api\CategoryController::class, 'store'])->middleware('auth:sanctum');

//Get All Categories (Seller)
Route::get('seller/categories',[App\Http\Controllers\Api\CategoryController::class, 'getAllCategories'])->middleware('auth:sanctum');

//Products
Route::apiResource('seller/products',App\Http\Controllers\Api\ProductController::class)->middleware('auth:sanctum');

//Update Products
Route::post('seller/products/{id}',[App\Http\Controllers\Api\ProductController::class, 'update'])->middleware('auth:sanctum');

//Address
Route::apiResource('/buyer/addresses', App\Http\Controllers\Api\AddressController::class)->middleware('auth:sanctum');

//Order
Route::post('buyer/orders',[App\Http\Controllers\Api\OrderController::class, 'createOrder'])->middleware('auth:sanctum');

//Store
Route::get('buyer/stores',[App\Http\Controllers\Api\StoreController::class, 'index'])->middleware('auth:sanctum');

//Product By Store
Route::get('buyer/stores/{id}/products',[App\Http\Controllers\Api\StoreController::class, 'productByStore'])->middleware('auth:sanctum');

//Seller Updata Resi
Route::put('seller/orders/{id}/update-resi',[App\Http\Controllers\Api\OrderController::class, 'updateShippingNumber'])->middleware('auth:sanctum');

//History Order Buyer
Route::get('buyer/histories',[App\Http\Controllers\Api\OrderController::class, 'historyOrderBuyer'])->middleware('auth:sanctum');

//History Order Seller
Route::get('seller/histories',[App\Http\Controllers\Api\OrderController::class, 'historyOrderSeller'])->middleware('auth:sanctum');

//Buyer Stores Live Streaming
Route::get('buyer/stores/livestreaming',[App\Http\Controllers\Api\StoreController::class, 'liveStreaming'])->middleware('auth:sanctum');






