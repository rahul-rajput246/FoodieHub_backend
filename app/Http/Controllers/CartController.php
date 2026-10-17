<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\FoodItems;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function calculateVerifiedItemPrice($food, $selectedVariation, $selectedAddons): array
    {
        $unitPrice = (float) $food->food_price;
        $verifiedVariation = null;
        $verifiedAddons = [];

        if (!empty($selectedVariation) && is_array($selectedVariation)) {
            $clientVarId = (string)($selectedVariation['id'] ?? '');
            $dbVariations = is_array($food->variations) ? $food->variations : [];
            foreach ($dbVariations as $v) {
                if ((string)($v['id'] ?? '') === $clientVarId) {
                    $varPrice = (float)($v['price'] ?? 0);
                    $unitPrice += $varPrice;
                    $verifiedVariation = [
                        'id' => $v['id'],
                        'name' => $v['name'] ?? ($selectedVariation['name'] ?? ''),
                        'price' => $varPrice,
                    ];
                    break;
                }
            }
        }

        if (!empty($selectedAddons) && is_array($selectedAddons)) {
            $dbAddons = is_array($food->addons) ? $food->addons : [];
            $clientAddonIds = [];
            foreach ($selectedAddons as $a) {
                if (isset($a['id'])) {
                    $clientAddonIds[] = (string)$a['id'];
                }
            }

            foreach ($dbAddons as $dbA) {
                $dbAId = (string)($dbA['id'] ?? '');
                if (in_array($dbAId, $clientAddonIds, true)) {
                    $addonPrice = (float)($dbA['price'] ?? 0);
                    $unitPrice += $addonPrice;
                    $verifiedAddons[] = [
                        'id' => $dbA['id'],
                        'name' => $dbA['name'] ?? '',
                        'price' => $addonPrice,
                    ];
                }
            }
        }

        return [
            'unit_price' => $unitPrice,
            'variation' => $verifiedVariation,
            'addons' => $verifiedAddons,
        ];
    }

    public function index()
    {
        $cartItems = CartItem::with('food')
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        $subtotal = 0;

        foreach ($cartItems as $item) {
            if ($item->food) {
                $calc = $this->calculateVerifiedItemPrice($item->food, $item->selected_variation, $item->selected_addons);
                $item->item_price = $calc['unit_price'];
            }
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
            if ($item->food) {
                $calc = $this->calculateVerifiedItemPrice($item->food, $item->selected_variation, $item->selected_addons);
                $item->item_price = $calc['unit_price'];
            }
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

        // Always verify and compute item price on the server directly from DB
        $calc = $this->calculateVerifiedItemPrice($food, $request->selected_variation, $request->selected_addons);
        $itemPrice = $calc['unit_price'];
        $verifiedVariation = $calc['variation'];
        $verifiedAddons = $calc['addons'];

        $cartKey = $request->cart_key ?: ('item_' . $food->id);

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
            $cartItem->item_price = $itemPrice;
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'food_item_id' => $food->id,
                'cart_key' => $cartKey,
                'quantity' => $request->quantity,
                'selected_variation' => $verifiedVariation,
                'selected_addons' => $verifiedAddons,
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
