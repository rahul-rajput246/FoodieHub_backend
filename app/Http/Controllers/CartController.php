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
            $price = $item->item_price ?? ($item->food ? $item->food->food_price : 0);
            $subtotal += $price * $item->quantity;
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
            $price = $item->item_price ?? ($item->food ? $item->food->food_price : 0);
            $subtotal += $price * $item->quantity;
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
            'cart_key' => 'nullable|string',
            'selected_variation' => 'nullable|array',
            'selected_addons' => 'nullable|array',
            'item_price' => 'nullable|numeric',
        ]);

        $food = FoodItems::findOrFail($request->food_item_id);

        $cartKey = $request->cart_key ?: ('item_' . $food->id);
        $itemPrice = $request->filled('item_price') ? (float)$request->item_price : (float)$food->food_price;

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where('cart_key', $cartKey)
            ->first();

        if (!$cartItem && !$request->filled('cart_key')) {
            $cartItem = CartItem::where('user_id', Auth::id())
                ->where('food_item_id', $food->id)
                ->whereNull('selected_variation')
                ->first();
        }

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'food_item_id' => $food->id,
                'cart_key' => $cartKey,
                'quantity' => $request->quantity,
                'selected_variation' => $request->selected_variation,
                'selected_addons' => $request->selected_addons,
                'item_price' => $itemPrice,
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
            'quantity' => 'required|integer|min:0',
        ]);

        if ($request->quantity <= 0) {
            return $this->removeCartItem($id);
        }

        $cartItem = CartItem::where('user_id', Auth::id())
            ->where(function ($q) use ($id) {
                $q->where('id', $id)
                  ->orWhere('cart_key', $id)
                  ->orWhere('food_item_id', $id);
            })
            ->first();

        if ($cartItem) {
            $cartItem->quantity = $request->quantity;
            $cartItem->save();
        }

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
        ]);
    }

    public function removeCartItem($id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())
            ->where(function ($q) use ($id) {
                $q->where('id', $id)
                  ->orWhere('cart_key', $id)
                  ->orWhere('food_item_id', $id);
            })
            ->first();

        if ($cartItem) {
            $cartItem->delete();
        }

        return response()->json([
            'success' => true,
            'message' => 'Item removed successfully',
        ]);
    }

    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);

        if ($cartItem->user_id != auth()->id()) {
            abort(403);
        }

        $cartItem->delete();

        return back()->with('success', 'Item removed from cart');
    }
}
