<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\HomeApiController;
use App\Http\Controllers\Api\FoodItemsApiController;
use Illuminate\Http\Request;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\Api\CouponApiController;

Route::get('/home-data/{page}' , [HomeApiController::class , 'homeApi']);

Route::get('/food-data' , [FoodItemsApiController::class , 'foodApi']);

Route::post('/contact', [ContactMessageController::class, 'store']);
Route::get('/orders/{id}/tracking', [OrderController::class, 'getTrackingDetails']);

// Coupons & Promo Codes
Route::get('/coupons/available', [CouponApiController::class, 'getAvailableCoupons']);
Route::post('/coupons/apply', [CouponApiController::class, 'applyCoupon']);

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
    Route::post('/cart/remove/{id}', [CartController::class, 'removeCartItem']);
});

Route::post('/login', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $throttleKey = \Illuminate\Support\Str::transliterate(
        \Illuminate\Support\Str::lower($request->input('email')) . '|' . $request->ip()
    );

    if (\Illuminate\Support\Facades\RateLimiter::tooManyAttempts($throttleKey, 5)) {
        $seconds = \Illuminate\Support\Facades\RateLimiter::availableIn($throttleKey);
        return response()->json([
            'success' => false,
            'message' => "Too many login attempts. Please try again in {$seconds} seconds.",
            'retry_after' => $seconds,
        ], 429);
    }

    if (!Illuminate\Support\Facades\Auth::attempt($request->only('email', 'password'))) {
        \Illuminate\Support\Facades\RateLimiter::hit($throttleKey, 60);
        return response()->json([
            'success' => false,
            'message' => 'Invalid credentials',
        ], 401);
    }

    \Illuminate\Support\Facades\RateLimiter::clear($throttleKey);
    $request->session()->regenerate();
    $user = Illuminate\Support\Facades\Auth::user();

    return response()->json([
        'success' => true,
        'user' => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $user->getRoleNames(),
        ],
        'redirect' => '/admin/dashboard',
    ]);
})->middleware('throttle:5,1');

// Wishlist API Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'getWishlist']);
    Route::post('/wishlist/add', [WishlistController::class, 'addToWishlist']);
    Route::delete('/wishlist/remove/{id}', [WishlistController::class, 'removeWishlistItem']);
});

