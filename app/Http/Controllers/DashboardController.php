<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FoodCategory;
use App\Models\FoodItems;
use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;

class DashboardController extends Controller
{
   public function dashboard(){ 
        $totalCategory = FoodCategory::count();
        $totalFood = FoodItems::count();
        $totalOrders = Order::count();
        $totalUsers = User::count();

        $pendingOrders   = Order::where('status', 'pending')->count();
        $deliveredOrders = Order::where('status', 'delivered')->count();
        $cancelledOrders = Order::where('status', 'cancelled')->count();
        $activeOrders  = FoodItems::where('food_status', 1)->count();

        $lowStockItems = FoodItems::where('food_stock', '<=', 5)->get();

        $recentOrders = Order::latest()->take(10)->get();

        return view('admin.dashboard', compact('totalCategory', 'totalFood', 'totalOrders', 'totalUsers', 'recentOrders', 'pendingOrders', 'deliveredOrders', 'cancelledOrders', 'activeOrders', 'lowStockItems'));

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
