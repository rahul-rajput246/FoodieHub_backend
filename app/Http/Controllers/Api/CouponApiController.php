<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;
use Illuminate\Support\Facades\Auth;

class CouponApiController extends Controller
{
    /**
     * Get list of active available coupons for customers
     */
    public function getAvailableCoupons(Request $request)
    {
        $userId = Auth::guard('sanctum')->id() ?? Auth::id();

        $coupons = Coupon::active()
            ->orderBy('min_order_amount', 'asc')
            ->get()
            ->map(function ($coupon) use ($userId) {
                $isUsedUp = false;
                if ($userId && $coupon->user_limit > 0) {
                    $usedCount = $coupon->usages()->where('user_id', $userId)->count();
                    $isUsedUp = $usedCount >= $coupon->user_limit;
                }

                return [
                    'id' => $coupon->id,
                    'code' => $coupon->code,
                    'description' => $coupon->description,
                    'discount_type' => $coupon->discount_type,
                    'discount_value' => (float) $coupon->discount_value,
                    'min_order_amount' => (float) $coupon->min_order_amount,
                    'max_discount_amount' => $coupon->max_discount_amount ? (float) $coupon->max_discount_amount : null,
                    'is_used_up' => $isUsedUp,
                    'expires_at' => $coupon->valid_until ? $coupon->valid_until->format('d M Y') : null,
                ];
            });

        return response()->json([
            'success' => true,
            'coupons' => $coupons,
        ]);
    }

    /**
     * Validate and apply coupon code to a subtotal
     */
    public function applyCoupon(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'subtotal' => 'required|numeric|min:0',
        ]);

        $code = strtoupper(trim($request->code));
        $subtotal = (float) $request->subtotal;
        $userId = Auth::guard('sanctum')->id() ?? Auth::id();

        $coupon = Coupon::where('code', $code)->first();

        if (!$coupon) {
            return response()->json([
                'success' => false,
                'message' => "Coupon code '{$code}' does not exist. Please check the spelling.",
            ], 404);
        }

        $validation = $coupon->validateFor($subtotal, $userId);

        if (!$validation['valid']) {
            return response()->json([
                'success' => false,
                'message' => $validation['message'],
            ], 422);
        }

        $discount = $validation['discount'];
        $deliveryFee = $subtotal > 499 ? 0 : 40;
        $finalTotal = max(0, $subtotal + $deliveryFee - $discount);

        return response()->json([
            'success' => true,
            'message' => $validation['message'],
            'coupon' => [
                'id' => $coupon->id,
                'code' => $coupon->code,
                'description' => $coupon->description,
                'discount_type' => $coupon->discount_type,
                'discount_value' => (float) $coupon->discount_value,
                'discount_amount' => $discount,
                'min_order_amount' => (float) $coupon->min_order_amount,
                'max_discount_amount' => $coupon->max_discount_amount ? (float) $coupon->max_discount_amount : null,
            ],
            'subtotal' => $subtotal,
            'delivery_fee' => $deliveryFee,
            'discount_amount' => $discount,
            'final_total' => $finalTotal,
        ]);
    }
}
