<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WishlistItem;
use App\Models\FoodItems;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistItems = WishlistItem::with('food')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('user.wishlist', compact('wishlistItems'));
    }

    public function getWishlist()
    {
        $wishlistItems = WishlistItem::with('food')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'wishlistItems' => $wishlistItems,
        ]);
    }

    public function addToWishlist(Request $request)
    {
        $request->validate([
            'food_item_id' => 'required|exists:foodItems,id',
        ]);

        $food = FoodItems::findOrFail($request->food_item_id);

        $existing = WishlistItem::where('user_id', Auth::id())
            ->where('food_item_id', $food->id)
            ->first();

        if (!$existing) {
            WishlistItem::create([
                'user_id' => Auth::id(),
                'food_item_id' => $food->id,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to wishlist successfully',
        ]);
    }

    public function removeWishlistItem($id)
    {
        $wishlistItem = WishlistItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $wishlistItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed from wishlist successfully',
        ]);
    }

    public function addWishlistItemToCart($id)
{
    $wishlistItem = WishlistItem::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $cartItem = CartItem::where('user_id', Auth::id())
        ->where('food_item_id', $wishlistItem->food_item_id)
        ->first();

    if ($cartItem) {
        $cartItem->quantity += 1;
        $cartItem->save();
    } else {
        CartItem::create([
            'user_id' => Auth::id(),
            'food_item_id' => $wishlistItem->food_item_id,
            'quantity' => 1,
        ]);
    }

    $wishlistItem->delete();

    return redirect()->route('wishlist.index')->with('success', 'Item moved to cart successfully.');
}


public function removeFromWishlistPage($id)
{
    $wishlistItem = WishlistItem::where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();

    $wishlistItem->delete();

    return redirect()->back()->with('success', 'Item removed from wishlist successfully.');
}


}
