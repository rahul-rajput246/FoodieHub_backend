<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCategory;
use App\Models\FoodItems;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;

use App\Models\CartItem;
use App\Models\WishlistItem;
use App\Models\UserAddress;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   public function dashboard(){ 
        $user = Auth::user();

        // User specific metrics
        $userTotalOrders = $user ? Order::where('user_id', $user->id)->count() : 0;
        $userWishlistCount = $user ? WishlistItem::where('user_id', $user->id)->count() : 0;
        $userCartCount = $user ? CartItem::where('user_id', $user->id)->count() : 0;
        $userAddressCount = $user ? UserAddress::where('user_id', $user->id)->count() : 0;
        $userRecentOrders = $user ? Order::with('items.food')
            ->where('user_id', $user->id)
            ->latest()
            ->take(5)
            ->get() : collect();

        // Admin store metrics
        $totalCategory = FoodCategory::count();
        $totalFood = FoodItems::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();

        $pendingOrders   = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $activeOrders    = FoodItems::where('food_status', 1)->count();

        $lowStockItems = FoodItems::where('food_stock', '<=', 5)->get();

        $recentOrders = Order::with('user')->latest()->take(10)->get();

        return view('admin.dashboard', compact(
            'totalCategory',
            'totalFood',
            'totalOrders',
            'totalUsers',
            'recentOrders',
            'pendingOrders',
            'deliveredOrders',
            'cancelledOrders',
            'activeOrders',
            'lowStockItems',
            'userTotalOrders',
            'userWishlistCount',
            'userCartCount',
            'userAddressCount',
            'userRecentOrders'
        ));

   }

   public function allUsers()
   {
      $users = User::latest()->paginate(10); 

      return view('admin.allUsers', compact('users'));
   }

   public function deleteUser($id)
   {
      User::findOrFail($id)->delete();

      return redirect()->route('admin.allUsers')->with('success', 'User deleted successfully');
   }

}
