<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeEditController;
use App\Http\Controllers\MenuEditController;
use App\Http\Controllers\AboutEditController;
use App\Http\Controllers\ContactEditController;
use App\Http\Controllers\FoodItemsController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\user\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\AdminCouponController;

Route::get('/', function () {
    return redirect('http://localhost:5173'); 
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/admin/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/admin/allPages', function () {
    return view('admin.allPages');
});

Route::get('/admin/allUsers', [DashboardController::class, 'allUsers'])->name('admin.allUsers');

Route::delete('/admin/user/{id}', [DashboardController::class, 'deleteUser'])->name('admin.deleteUser');

// Category Routes

Route::get('/admin/allCategory', [FoodCategoryController::class, 'allCategory'])->name('admin.category');
Route::get('/admin/forms/createCategory', [FoodCategoryController::class, 'addCategory'])->name('admin.create.category');
Route::post('/admin/forms/store/createCategory', [FoodCategoryController::class, 'updateCategory'])->name('admin.category.update');

// Food Routes

Route::get('/admin/allFood', [FoodItemsController::class, 'createFood'])->name('admin.allFood');

Route::get('/admin/forms/createfood', [FoodItemsController::class, 'createFoodForm'])->name('admin.forms.createFood');

// Admin Home Form Post and Get Route

Route::get('/admin/pages/home/edit', [HomeEditController::class, 'create'])->name('admin.home');
Route::post('/admin/pages/home/store', [HomeEditController::class, 'update'])->name('home_update');

// Admin Menu Form Post and Get Route

Route::get('/admin/pages/menu/edit', [MenuEditController::class, 'menuCreate'])->name('admin.menu');
Route::post('/admin/pages/menu/store', [MenuEditController::class, 'menuUpdate'])->name('menu_update');

// Admin About Form Post and Get Route

Route::get('/admin/pages/about/edit', [AboutEditController::class, 'aboutCreate'])->name('admin.about');
Route::post('/admin/pages/about/store', [AboutEditController::class, 'aboutUpdate'])->name('about_update');

// Admin Contact Form Post And Get Route

Route::get('/admin/pages/contact/edit', [ContactEditController::class, 'contactCreate'])->name('admin.contact');
Route::post('/admin/pages/contact/store', [ContactEditController::class, 'contactUpdate'])->name('contact_update');

// Admin Create Food Post And Get Route

// Route::get('/admin/forms/createFood/edit', [FoodItemsController::class, 'createFood'])->name('admin.createFood');
Route::post('/admin/forms/createFood/store', [FoodItemsController::class, 'createFoodUpdate'])->name('createFood_update');

// Admin Edit Food Item

Route::get('/admin/food/{id}/edit', [FoodItemsController::class, 'editFood'])->name('food.edit');
Route::post('/admin/food/{id}/update', [FoodItemsController::class, 'updateFood'])->name('food.update');

// Admin Delete Food Item

Route::get('/admin/food/delete/{id}', [FoodItemsController::class, 'deleteFood'])->name('admin.food.delete');

// User Profile Route

Route::get('/user/profile', function () {
    return view('user.profile');
})->name('user.profile');

Route::post('/user/profile/update', [UserController::class, 'update'])->name('user.profile.update');

Route::post('/user/password/update', [UserController::class, 'updatePassword'])
    ->name('user.password.update');

Route::post('/user/address/save', [UserController::class, 'saveAddress'])
    ->name('user.address.save');

Route::post('/user/address/update/{id}', [UserController::class, 'updateAddress'])
    ->name('user.address.update');

Route::get('/user/address/edit/{id}', [UserController::class, 'editAddress'])
    ->name('user.address.edit');

Route::get('/user/address/delete/{id}', [UserController::class, 'deleteAddress'])
    ->name('user.address.delete');

// Orders Routes

Route::get('/admin/orders/pending' , [OrderController::class, 'pendingOrders'])->name('orders.pending');

Route::get('/admin/orders/completed', [OrderController::class, 'completedOrders'])->name('orders.completed');

Route::get('/admin/orders/cancelled', [OrderController::class, 'cancelledOrders'])
    ->name('admin.orders.cancelled');

// Cart Routes

Route::middleware('auth')->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

// User Order Route

Route::middleware('auth')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{id}', [OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{id}/invoice', [OrderController::class, 'downloadInvoice'])->name('orders.invoice');
    Route::get('/orders/{id}/receipt', [OrderController::class, 'printReceipt'])->name('orders.receipt');
    Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
});

// Public Live Order Tracking Route
Route::get('/orders/{id}/tracking', [OrderController::class, 'getTrackingDetails'])->name('orders.tracking');

// Admin Order Routes

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/orders', [OrderController::class, 'adminIndex'])->name('admin.orders');
    Route::get('/admin/orders/{id}', [OrderController::class, 'adminShow'])->name('admin.orders.show');
    Route::get('/admin/orders/{id}/invoice', [OrderController::class, 'adminDownloadInvoice'])->name('admin.orders.invoice');
    Route::get('/admin/orders/{id}/receipt', [OrderController::class, 'adminPrintReceipt'])->name('admin.orders.receipt');
    Route::get('/admin/orders/{id}/send-email', [OrderController::class, 'resendOrderMail'])->name('admin.orders.sendEmail');
    Route::post('/admin/orders/{id}/update', [OrderController::class, 'updateStatus'])->name('admin.orders.status');

    // Contact Messages Management
    Route::get('/admin/messages', [ContactMessageController::class, 'index'])->name('admin.messages.index');
    Route::get('/admin/messages/{id}', [ContactMessageController::class, 'show'])->name('admin.messages.show');
    Route::post('/admin/messages/{id}/status', [ContactMessageController::class, 'updateStatus'])->name('admin.messages.status');
    Route::post('/admin/messages/{id}/reply', [ContactMessageController::class, 'sendReply'])->name('admin.messages.reply');
    Route::delete('/admin/messages/{id}', [ContactMessageController::class, 'destroy'])->name('admin.messages.destroy');

    // Coupon & Promo Code Management
    Route::get('/admin/coupons', [AdminCouponController::class, 'index'])->name('admin.coupons.index');
    Route::get('/admin/coupons/create', [AdminCouponController::class, 'create'])->name('admin.coupons.create');
    Route::post('/admin/coupons/store', [AdminCouponController::class, 'store'])->name('admin.coupons.store');
    Route::get('/admin/coupons/{id}/edit', [AdminCouponController::class, 'edit'])->name('admin.coupons.edit');
    Route::post('/admin/coupons/{id}/update', [AdminCouponController::class, 'update'])->name('admin.coupons.update');
    Route::post('/admin/coupons/{id}/toggle', [AdminCouponController::class, 'toggleStatus'])->name('admin.coupons.toggle');
    Route::delete('/admin/coupons/{id}', [AdminCouponController::class, 'destroy'])->name('admin.coupons.destroy');
});

// Cart Route

Route::delete('/cart/remove/{id}', [CartController::class, 'removeItem'])->name('cart.remove');

// Wishlist Route

Route::middleware('auth')->group(function () {
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist/add-to-cart/{id}', [WishlistController::class, 'addWishlistItemToCart'])->name('wishlist.addToCart');
    Route::post('/wishlist/remove/{id}', [WishlistController::class, 'removeFromWishlistPage'])->name('wishlist.remove');
});

