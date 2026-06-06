<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\FoodItems;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cartItems = CartItem::with('food')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $subtotal = 0;

        foreach ($cartItems as $item) {
            if ($item->food) {
                $subtotal += $item->food->food_price * $item->quantity;
            }
        }

        return view('user.cart', compact('cartItems', 'subtotal'));
    }

    public function getCart()
    {
        $cartItems = CartItem::with('food')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $subtotal = 0;

        foreach ($cartItems as $item) {
            if ($item->food) {
                $subtotal += $item->food->food_price * $item->quantity;
            }
        }

        return response()->json([
            'success' => true,
            'cartItems' => $cartItems,
            'subtotal' => $subtotal,
        ]);
    }

    public function addToCart(Request $request)
    {
        $request->validate([
            'food_item_id' => 'required|exists:foodItems,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $food = FoodItems::findOrFail($request->food_item_id);

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('food_item_id', $food->id)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'food_item_id' => $food->id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Item added to cart successfully',
        ]);
    }

    public function updateCart(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
        ]);
    }

    public function removeCartItem($id)
    {
        $cartItem = CartItem::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $cartItem->delete();

        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully',
        ]);
    }

    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);

        // Optional: make sure user owns this cart item
        if ($cartItem->user_id != auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart');
    }

}
