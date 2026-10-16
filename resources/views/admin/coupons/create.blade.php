@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Marketing & Promos</p>
            <h1>Create New Coupon</h1>
            <p class="pages_desc">
                Configure discount rules, order minimums, validity periods, and customer redemption limits.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.coupons.index') }}" class="create_food_btn" style="background:#f3f4f6; color:#374151; font-weight:600; text-decoration:none; padding:10px 18px; border-radius:8px; display:inline-block;">← Back to Coupons</a>
        </div>
    </div>

    @if ($errors->any())
        <div style="margin-bottom:20px; padding:12px 18px; background:#fee2e2; color:#991b1b; border-radius:8px; font-weight:600; border-left:4px solid #ef4444;">
            <ul style="margin:0; padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- FORM -->
    <div class="page_form_wrapper">
        <div class="main_form_box" style="background:#fff; border-radius:12px; padding:24px; box-shadow:0 1px 3px rgba(0,0,0,0.1);">

            <div class="form_card_title_row" style="margin-bottom:20px; border-bottom:1px solid #f3f4f6; padding-bottom:12px;">
                <h3 style="margin:0; font-size:18px; color:#111827;">Coupon Configuration</h3>
                <p style="margin:4px 0 0 0; color:#6b7280; font-size:13px;">Specify the code and discount terms.</p>
            </div>

            <form method="POST" action="{{ route('admin.coupons.store') }}">
                @csrf

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
                    <div class="form_group">
                        <label for="code" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Coupon Code *</label>
                        <input type="text" id="code" name="code" value="{{ old('code') }}" placeholder="e.g. FESTIVE50" required style="width:100%; text-transform:uppercase; font-weight:700; letter-spacing:1px; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                        <small style="color:#6b7280; font-size:11px;">Must be unique. Customers will enter this code.</small>
                    </div>

                    <div class="form_group">
                        <label for="description" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Customer Facing Description</label>
                        <input type="text" id="description" name="description" value="{{ old('description') }}" placeholder="e.g. ₹50 OFF on all orders above ₹299" style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                        <small style="color:#6b7280; font-size:11px;">Shown on checkout offers card.</small>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-top:16px;">
                    <div class="form_group">
                        <label for="discount_type" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Discount Type *</label>
                        <select id="discount_type" name="discount_type" required class="custom_select" style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                            <option value="fixed" {{ old('discount_type') == 'fixed' ? 'selected' : '' }}>Fixed Amount (₹ Flat OFF)</option>
                            <option value="percentage" {{ old('discount_type') == 'percentage' ? 'selected' : '' }}>Percentage (% OFF)</option>
                        </select>
                    </div>

                    <div class="form_group">
                        <label for="discount_value" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Discount Value *</label>
                        <input type="number" step="0.01" min="1" id="discount_value" name="discount_value" value="{{ old('discount_value', 50) }}" placeholder="e.g. 50 or 20" required style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                        <small style="color:#6b7280; font-size:11px;">₹ amount for fixed, or % percentage.</small>
                    </div>

                    <div class="form_group">
                        <label for="max_discount_amount" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Max Cap Amount (₹)</label>
                        <input type="number" step="0.01" min="0" id="max_discount_amount" name="max_discount_amount" value="{{ old('max_discount_amount') }}" placeholder="e.g. 150 (for % discounts)" style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                        <small style="color:#6b7280; font-size:11px;">Leave empty for no maximum cap.</small>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:16px; margin-top:16px;">
                    <div class="form_group">
                        <label for="min_order_amount" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Minimum Order Subtotal (₹) *</label>
                        <input type="number" step="0.01" min="0" id="min_order_amount" name="min_order_amount" value="{{ old('min_order_amount', 199) }}" required style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                        <small style="color:#6b7280; font-size:11px;">0 for no minimum requirement.</small>
                    </div>

                    <div class="form_group">
                        <label for="usage_limit" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Total Usage Limit</label>
                        <input type="number" min="0" id="usage_limit" name="usage_limit" value="{{ old('usage_limit', 0) }}" placeholder="0 for unlimited" style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                        <small style="color:#6b7280; font-size:11px;">0 means unlimited total uses across store.</small>
                    </div>

                    <div class="form_group">
                        <label for="user_limit" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Per-User Limit</label>
                        <input type="number" min="1" id="user_limit" name="user_limit" value="{{ old('user_limit', 1) }}" required style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                        <small style="color:#6b7280; font-size:11px;">How many times a single customer can use it.</small>
                    </div>
                </div>

                <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-top:16px;">
                    <div class="form_group">
                        <label for="valid_from" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Valid From (Optional)</label>
                        <input type="datetime-local" id="valid_from" name="valid_from" value="{{ old('valid_from') }}" style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                    </div>

                    <div class="form_group">
                        <label for="valid_until" style="display:block; margin-bottom:6px; font-weight:600; font-size:13px; color:#374151;">Valid Until / Expiry (Optional)</label>
                        <input type="datetime-local" id="valid_until" name="valid_until" value="{{ old('valid_until') }}" style="width:100%; padding:10px 12px; border:1px solid #d1d5db; border-radius:8px;">
                    </div>
                </div>

                <div class="form_group" style="margin-top:20px; display:flex; align-items:center; gap:10px;">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }} style="width:18px; height:18px; accent-color:#ff7e00; cursor:pointer;">
                    <label for="is_active" style="cursor:pointer; font-weight:600; font-size:14px; color:#111827;">Activate coupon immediately</label>
                </div>

                <div class="page_form_submit_box" style="margin-top:24px; padding-top:16px; border-top:1px solid #f3f4f6; display:flex; justify-content:flex-end; gap:12px;">
                    <a href="{{ route('admin.coupons.index') }}" style="padding:10px 20px; background:#f3f4f6; color:#4b5563; font-weight:600; border-radius:8px; text-decoration:none;">Cancel</a>
                    <button type="submit" class="save_page_btn" style="padding:10px 24px; background:#ff7e00; color:#fff; font-weight:700; border:none; border-radius:8px; cursor:pointer;">Create Coupon</button>
                </div>
            </form>

        </div>
    </div>

    @include('components.usable.footer')

</div>

@endsection
