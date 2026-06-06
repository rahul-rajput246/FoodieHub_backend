<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\FoodItemsApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;

Route::get('/home-data/{page}' , [HomeApiController::class , 'homeApi']);

Route::get('/food-data' , [FoodItemsApiController::class , 'foodApi']);

// Admin Login Credentials Route

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return response()->json([
        'id' => $request->user()->id,
        'name' => $request->user()->name,
        'roles' => $request->user()->getRoleNames(),
    ]);
});

Route::middleware('auth:sanctum')->post('/place-order', [OrderController::class, 'storeApi']);

Route::middleware('auth:sanctum')->get('/user-addresses', function (Request $request) {
    return response()->json(
        $request->user()->addresses()->get()
    );
});

Route::middleware('auth:sanctum')->post('/create-razorpay-order', [OrderController::class, 'createRazorpayOrder']);
Route::middleware('auth:sanctum')->post('/verify-razorpay-payment', [OrderController::class, 'verifyRazorpayPayment']);

// Cart API Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::post('/cart/update/{id}', [CartController::class, 'updateCart']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeCartItem']);
});

// Wishlist API Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'getWishlist']);
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlistItem']);
});

