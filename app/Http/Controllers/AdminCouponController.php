<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use Carbon\Carbon;

class AdminCouponController extends Controller
{
    /**
     * List all coupons with stats
     */
    public function index()
    {
        $coupons = Coupon::withCount('usages')
            ->latest()
            ->get();

        return view('admin.coupons.index', compact('coupons'));
    }

    /**
     * Show coupon creation form
     */
    public function create()
    {
        return view('admin.coupons.create');
    }

    /**
     * Store new coupon
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code',
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric|min:1',
            'min_order_amount' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'user_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        if (empty($validated['user_limit'])) {
            $validated['user_limit'] = 1;
        }

        Coupon::create($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', "Coupon '{$validated['code']}' created successfully!");
    }

    /**
     * Show edit form
     */
    public function edit($id)
    {
        $coupon = Coupon::withCount('usages')->findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    /**
     * Update existing coupon
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::findOrFail($id);

        $validated = $request->validate([
            'code' => 'required|string|max:50|unique:coupons,code,' . $coupon->id,
            'description' => 'nullable|string|max:255',
            'discount_type' => 'required|in:fixed,percentage',
            'discount_value' => 'required|numeric|min:1',
            'min_order_amount' => 'required|numeric|min:0',
            'max_discount_amount' => 'nullable|numeric|min:0',
            'usage_limit' => 'nullable|integer|min:0',
            'user_limit' => 'nullable|integer|min:1',
            'valid_from' => 'nullable|date',
            'valid_until' => 'nullable|date|after_or_equal:valid_from',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['code'] = strtoupper(trim($validated['code']));
        $validated['is_active'] = $request->has('is_active') ? 1 : 0;
        if (empty($validated['user_limit'])) {
            $validated['user_limit'] = 1;
        }

        $coupon->update($validated);

        return redirect()->route('admin.coupons.index')
            ->with('success', "Coupon '{$coupon->code}' updated successfully!");
    }

    /**
     * Toggle coupon active status
     */
    public function toggleStatus($id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->is_active = !$coupon->is_active;
        $coupon->save();

        $statusStr = $coupon->is_active ? 'activated' : 'deactivated';
        return redirect()->back()
            ->with('success', "Coupon '{$coupon->code}' has been {$statusStr}.");
    }

    /**
     * Delete coupon
     */
    public function destroy($id)
    {
        $coupon = Coupon::findOrFail($id);
        $code = $coupon->code;
        $coupon->delete();

        return redirect()->route('admin.coupons.index')
            ->with('success', "Coupon '{$code}' deleted successfully.");
    }
}
