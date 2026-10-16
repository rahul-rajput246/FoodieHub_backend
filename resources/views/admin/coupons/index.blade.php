@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <!-- HEADER -->
    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">FoodieHub Marketing & Promos</p>
            <h1>Coupons & Promo Codes</h1>
            <p class="pages_desc">
                Create and manage customer discounts, percentage off offers, minimum cart rules, and redemption limits.
            </p>
        </div>

        <div>
            <a href="{{ route('admin.coupons.create') }}" class="create_food_btn" style="background:#ff7e00; color:#fff; font-weight:700; text-decoration:none; padding:10px 18px; border-radius:8px; display:inline-block;">+ Create New Coupon</a>
        </div>
    </div>

    @if(session('success'))
        <div style="margin-bottom:20px; padding:12px 18px; background:#d1fae5; color:#065f46; border-radius:8px; font-weight:600; border-left:4px solid #10b981;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="margin-bottom:20px; padding:12px 18px; background:#fee2e2; color:#991b1b; border-radius:8px; font-weight:600; border-left:4px solid #ef4444;">
            {{ session('error') }}
        </div>
    @endif

    <!-- OVERVIEW CARDS -->
    <div class="pages_overview_cards" style="display:grid; grid-template-columns:repeat(auto-fit, minmax(220px, 1fr)); gap:18px; margin-bottom:24px;">
        <div class="mini_overview_card">
            <h3>Total Promo Codes</h3>
            <h2>{{ $coupons->count() }}</h2>
            <p>Active and inactive campaigns</p>
        </div>

        <div class="mini_overview_card">
            <h3>Active Coupons</h3>
            <h2 style="color:#10b981;">{{ $coupons->where('is_active', 1)->count() }}</h2>
            <p>Usable right now by customers</p>
        </div>

        <div class="mini_overview_card">
            <h3>Total Redemptions</h3>
            <h2 style="color:#ff7e00;">{{ $coupons->sum('used_count') }}</h2>
            <p>Orders with coupon savings</p>
        </div>
    </div>

    <!-- TABLE -->
    <div class="allfood_table_box">
        <div class="box_title_row" style="display:flex; justify-content:space-between; align-items:center;">
            <h3>Available Promo Codes</h3>
            <span style="font-size:13px; color:#6b7280;">Showing {{ $coupons->count() }} codes</span>
        </div>

        <div class="dashboard_table_wrapper" style="overflow-x:auto;">
            <table class="dashboard_table allfood_table" style="width:100%; border-collapse:collapse;">
                <thead>
                    <tr style="border-bottom:1px solid #e5e7eb; text-align:left;">
                        <th style="padding:12px 14px;">Coupon Code</th>
                        <th style="padding:12px 14px;">Discount</th>
                        <th style="padding:12px 14px;">Min Order</th>
                        <th style="padding:12px 14px;">Max Cap</th>
                        <th style="padding:12px 14px;">Uses / Limit</th>
                        <th style="padding:12px 14px;">Validity</th>
                        <th style="padding:12px 14px;">Status</th>
                        <th style="padding:12px 14px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($coupons as $coupon)
                    <tr style="border-bottom:1px solid #f3f4f6;">
                        <td style="padding:14px;">
                            <div style="display:flex; align-items:center; gap:8px;">
                                <span style="font-family:monospace; font-size:14px; font-weight:700; background:#fff7ed; color:#c2410c; border:1px dashed #fdba74; padding:4px 8px; border-radius:6px; letter-spacing:1px;">
                                    {{ $coupon->code }}
                                </span>
                            </div>
                            @if($coupon->description)
                                <div style="font-size:11px; color:#6b7280; margin-top:4px;">{{ $coupon->description }}</div>
                            @endif
                        </td>
                        <td style="padding:14px; font-weight:600; color:#111827;">
                            @if($coupon->discount_type === 'percentage')
                                <span style="color:#059669; font-weight:700;">{{ (int) $coupon->discount_value }}% OFF</span>
                            @else
                                <span style="color:#2563eb; font-weight:700;">₹{{ number_format($coupon->discount_value, 0) }} FLAT OFF</span>
                            @endif
                        </td>
                        <td style="padding:14px; color:#374151;">
                            ₹{{ number_format($coupon->min_order_amount, 0) }}
                        </td>
                        <td style="padding:14px; color:#6b7280;">
                            {{ $coupon->max_discount_amount ? '₹' . number_format($coupon->max_discount_amount, 0) : 'None' }}
                        </td>
                        <td style="padding:14px;">
                            <span style="font-weight:600; color:#111827;">{{ $coupon->used_count }}</span>
                            <span style="color:#9ca3af; font-size:12px;"> / {{ $coupon->usage_limit > 0 ? $coupon->usage_limit : '∞' }}</span>
                            <div style="font-size:11px; color:#6b7280;">Max {{ $coupon->user_limit }}/user</div>
                        </td>
                        <td style="padding:14px; font-size:12px; color:#4b5563;">
                            @if($coupon->valid_until)
                                @if($coupon->valid_until->isPast())
                                    <span style="color:#dc2626; font-weight:600;">Expired ({{ $coupon->valid_until->format('d M Y') }})</span>
                                @else
                                    <span>Until {{ $coupon->valid_until->format('d M Y') }}</span>
                                @endif
                            @else
                                <span style="color:#10b981;">No Expiry</span>
                            @endif
                        </td>
                        <td style="padding:14px;">
                            @if($coupon->is_active)
                                <span style="background:#d1fae5; color:#065f46; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; display:inline-block;">Active</span>
                            @else
                                <span style="background:#f3f4f6; color:#6b7280; font-size:11px; font-weight:700; padding:3px 10px; border-radius:20px; display:inline-block;">Inactive</span>
                            @endif
                        </td>
                        <td style="padding:14px; text-align:right;">
                            <div style="display:inline-flex; align-items:center; gap:8px;">
                                <!-- Toggle Active Status Form -->
                                <form method="POST" action="{{ route('admin.coupons.toggle', $coupon->id) }}" style="display:inline;">
                                    @csrf
                                    <button type="submit" title="{{ $coupon->is_active ? 'Deactivate Coupon' : 'Activate Coupon' }}" style="border:none; background:none; cursor:pointer; padding:5px 8px; font-size:12px; font-weight:600; border-radius:6px; background:{{ $coupon->is_active ? '#fee2e2' : '#d1fae5' }}; color:{{ $coupon->is_active ? '#991b1b' : '#065f46' }};">
                                        {{ $coupon->is_active ? 'Disable' : 'Enable' }}
                                    </button>
                                </form>

                                <!-- Edit Link -->
                                <a href="{{ route('admin.coupons.edit', $coupon->id) }}" style="text-decoration:none; padding:5px 10px; font-size:12px; font-weight:600; border-radius:6px; background:#eff6ff; color:#1d4ed8;">
                                    Edit
                                </a>

                                <!-- Delete Form -->
                                <form method="POST" action="{{ route('admin.coupons.destroy', $coupon->id) }}" onsubmit="return confirm('Are you sure you want to delete coupon {{ $coupon->code }}?');" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete Coupon" style="border:none; background:#f3f4f6; cursor:pointer; padding:5px 8px; font-size:12px; border-radius:6px; color:#ef4444;">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" style="text-align:center; padding:30px; color:#9ca3af;">
                            No promo codes found. Click "+ Create New Coupon" above to add your first promotion.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @include('components.usable.footer')

</div>

@endsection
