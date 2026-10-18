@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">Customer Portal</p>
            <h1>Order Details #{{ $order->order_number }}</h1>
            <p class="dashboard_desc">
                Placed on {{ $order->created_at->format('d M Y, h:i A') }} • Status: {{ ucfirst($order->status) }}
            </p>
        </div>

        <div class="dashboard_header_right" style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="{{ config('app.frontend_url') }}/track-order/{{ $order->order_number }}" target="_blank" class="dashboard_top_btn" style="background: linear-gradient(135deg, #ff7e00 0%, #ea580c 100%); display: inline-flex; align-items: center; gap: 6px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="5.5" cy="17.5" r="3.5"></circle>
                    <circle cx="18.5" cy="17.5" r="3.5"></circle>
                    <path d="M15 6h4l2 5.5-2.5 1"></path>
                    <path d="M9 17.5h6"></path>
                    <path d="M12 9l-3 8.5"></path>
                    <path d="M7 6h5"></path>
                </svg>
                Track Live on Map
            </a>
            <a href="{{ route('orders.invoice', $order->id) }}" class="dashboard_top_btn" style="background: #2563eb; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                    <polyline points="14 2 14 8 20 8"></polyline>
                    <line x1="16" y1="13" x2="8" y2="13"></line>
                    <line x1="16" y1="17" x2="8" y2="17"></line>
                </svg>
                Download Invoice
            </a>
            <a href="{{ route('orders.receipt', $order->id) }}" target="_blank" class="dashboard_top_btn" style="background: #059669; display: inline-flex; align-items: center; gap: 6px;">
                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="6 9 6 2 18 2 18 9"></polyline>
                    <path d="M6 18H4a2 2 0 0 1-2-2v-5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v5a2 2 0 0 1-2 2h-2"></path>
                    <rect x="6" y="14" width="12" height="8"></rect>
                </svg>
                Print Receipt
            </a>
            <a href="{{ route('orders.index') }}" class="dashboard_top_btn" style="background: #374151;">← Back to Orders</a>
            <a href="{{ config('app.frontend_url') }}/Menu" class="dashboard_top_btn">+ Order Again</a>
        </div>
    </div>

    @php
        $statusSteps = [
            'pending' => 1,
            'confirmed' => 2,
            'preparing' => 3,
            'out_for_delivery' => 4,
            'delivered' => 5,
            'cancelled' => 0
        ];
        $currentStep = $statusSteps[$order->status] ?? 1;

        $etaMap = [
            'pending' => '30–35 Mins',
            'confirmed' => '25–30 Mins',
            'preparing' => '15–20 Mins',
            'out_for_delivery' => '5–10 Mins',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
        ];
    @endphp

    {{-- Live Order Stepper Card --}}
    <div class="allfood_table_box" style="margin-bottom: 24px; border: 1px solid #fed7aa; background: #ffffff;">
        <div class="box_title_row" style="display: flex; justify-content: space-between; align-items: center;">
            <div style="display: flex; align-items: center; gap: 8px;">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#ea580c" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="5.5" cy="17.5" r="3.5"></circle>
                    <circle cx="18.5" cy="17.5" r="3.5"></circle>
                    <path d="M15 6h4l2 5.5-2.5 1"></path>
                    <path d="M9 17.5h6"></path>
                    <path d="M12 9l-3 8.5"></path>
                    <path d="M7 6h5"></path>
                </svg>
                <h3 style="margin: 0; color: #111827;">Live Delivery Journey</h3>
            </div>
            <div style="display: flex; align-items: center; gap: 10px;">
                <span style="font-size: 13px; font-weight: 600; color: #ea580c; background: #fff4ea; padding: 4px 12px; border-radius: 20px; display: inline-flex; align-items: center; gap: 5px;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 14 14"></polyline>
                    </svg>
                    ETA: {{ $etaMap[$order->status] ?? '25–30 Mins' }}
                </span>
                <a href="{{ config('app.frontend_url') }}/track-order/{{ $order->order_number }}" target="_blank" style="font-size: 12px; color: #2563eb; text-decoration: underline; font-weight: 600;">
                    Open Full Map View →
                </a>
            </div>
        </div>

        <div style="padding: 24px 10px;">
            <div style="display: flex; justify-content: space-between; align-items: center; position: relative; max-width: 800px; margin: 0 auto;">
                
                {{-- Step 1 --}}
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center; z-index: 2; width: 100px;">
                    <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $currentStep >= 1 ? '#10b981' : '#e5e7eb' }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 8px;">
                        {{ $currentStep > 1 ? '✓' : '1' }}
                    </div>
                    <span style="font-size: 13px; font-weight: 700; color: #111827;">Order Placed</span>
                    <span style="font-size: 11px; color: #6b7280;">{{ $order->created_at->format('h:i A') }}</span>
                </div>

                {{-- Connector 1-2 --}}
                <div style="flex: 1; height: 4px; background: {{ $currentStep >= 2 ? '#10b981' : '#e5e7eb' }}; margin: 0 -10px; margin-bottom: 24px;"></div>

                {{-- Step 2 --}}
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center; z-index: 2; width: 100px;">
                    <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $currentStep >= 2 ? ($currentStep == 2 ? '#ff7e00' : '#10b981') : '#e5e7eb' }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 8px;">
                        {{ $currentStep > 2 ? '✓' : '2' }}
                    </div>
                    <span style="font-size: 13px; font-weight: 700; color: #111827;">Confirmed</span>
                    <span style="font-size: 11px; color: #6b7280;">{{ $order->created_at->addMinutes(2)->format('h:i A') }}</span>
                </div>

                {{-- Connector 2-3 --}}
                <div style="flex: 1; height: 4px; background: {{ $currentStep >= 3 ? '#10b981' : '#e5e7eb' }}; margin: 0 -10px; margin-bottom: 24px;"></div>

                {{-- Step 3 --}}
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center; z-index: 2; width: 100px;">
                    <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $currentStep >= 3 ? ($currentStep == 3 ? '#ff7e00' : '#10b981') : '#e5e7eb' }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 8px;">
                        {{ $currentStep > 3 ? '✓' : '3' }}
                    </div>
                    <span style="font-size: 13px; font-weight: 700; color: #111827;">Preparing</span>
                    <span style="font-size: 11px; color: #6b7280;">Chef cooking</span>
                </div>

                {{-- Connector 3-4 --}}
                <div style="flex: 1; height: 4px; background: {{ $currentStep >= 4 ? '#10b981' : '#e5e7eb' }}; margin: 0 -10px; margin-bottom: 24px;"></div>

                {{-- Step 4 --}}
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center; z-index: 2; width: 100px;">
                    <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $currentStep >= 4 ? ($currentStep == 4 ? '#ff7e00' : '#10b981') : '#e5e7eb' }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 8px;">
                        {{ $currentStep > 4 ? '✓' : '4' }}
                    </div>
                    <span style="font-size: 13px; font-weight: 700; color: #111827;">On The Way</span>
                    <span style="font-size: 11px; color: #6b7280;">Rider dispatched</span>
                </div>

                {{-- Connector 4-5 --}}
                <div style="flex: 1; height: 4px; background: {{ $currentStep >= 5 ? '#10b981' : '#e5e7eb' }}; margin: 0 -10px; margin-bottom: 24px;"></div>

                {{-- Step 5 --}}
                <div style="display: flex; flex-direction: column; align-items: center; text-align: center; z-index: 2; width: 100px;">
                    <div style="width: 38px; height: 38px; border-radius: 50%; background: {{ $currentStep >= 5 ? '#10b981' : '#e5e7eb' }}; color: #fff; display: flex; align-items: center; justify-content: center; font-weight: 700; margin-bottom: 8px;">
                        {{ $currentStep >= 5 ? '✓' : '5' }}
                    </div>
                    <span style="font-size: 13px; font-weight: 700; color: #111827;">Delivered</span>
                    <span style="font-size: 11px; color: #6b7280;">Completed</span>
                </div>

            </div>
        </div>
    </div>

    <div class="dashboard_grid">

        <div class="dashboard_table_box">
            <div class="box_title_row">
                <h3>Ordered Items</h3>
            </div>

            @if($order->items->count())
                <div class="dashboard_table_wrapper">
                    <table class="dashboard_table">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>
                                        <strong>{{ $item->food_name }}</strong>
                                    </td>
                                    <td>₹{{ number_format($item->price, 2) }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td><strong>₹{{ number_format($item->subtotal, 2) }}</strong></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #e5e7eb; display: flex; justify-content: flex-end;">
                    <div style="font-size: 18px; font-weight: 700; color: #111827;">
                        Grand Total: <span style="color: #ff7e00;">₹{{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            @else
                <p style="padding: 20px 0; color: #6b7280;">No items found for this order.</p>
            @endif
        </div>

        <div class="dashboard_side_boxes">
            {{-- Order Summary Info --}}
            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Order Summary</h3>
                </div>

                <div class="overview_item">
                    <span>Order Status</span>
                    <span class="order_status {{ strtolower($order->status) }}">{{ ucfirst($order->status) }}</span>
                </div>
                <div class="overview_item">
                    <span>Payment Method</span>
                    <strong>{{ $order->payment_method ? strtoupper($order->payment_method) : 'N/A' }}</strong>
                </div>
                <div class="overview_item">
                    <span>Payment Status</span>
                    <strong>{{ ucfirst($order->payment_status) }}</strong>
                </div>
                @if(!empty($order->notes))
                <div class="overview_item" style="flex-direction: column; align-items: flex-start; gap: 4px;">
                    <span>Notes</span>
                    <p style="font-size: 13px; color: #4b5563; margin: 0;">{{ $order->notes }}</p>
                </div>
                @endif
            </div>

            {{-- Delivery Address --}}
            <div class="small_dashboard_box">
                <div class="box_title_row">
                    <h3>Delivery Address</h3>
                </div>

                @if($order->address)
                    <div style="font-size: 14px; line-height: 1.6; color: #374151;">
                        <strong style="color: #111827; font-size: 15px;">{{ $order->address->full_name }}</strong>
                        <p style="margin: 4px 0; display: flex; align-items: center; gap: 5px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                            </svg>
                            {{ $order->address->mobile }}
                        </p>
                        <p style="margin: 4px 0; display: flex; align-items: center; gap: 5px;">
                            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                            {{ $order->address->address_line }}
                        </p>
                        <p style="margin: 4px 0;">{{ $order->address->city }}, {{ $order->address->state }} - {{ $order->address->pincode }}</p>
                        @if(!empty($order->address->landmark))
                            <p style="margin: 4px 0;"><small>Landmark: {{ $order->address->landmark }}</small></p>
                        @endif
                        @if(!empty($order->address->type))
                            <span style="display: inline-block; background: #e5e7eb; padding: 2px 8px; border-radius: 4px; font-size: 11px; text-transform: uppercase; font-weight: 600; margin-top: 6px;">{{ $order->address->type }}</span>
                        @endif
                    </div>
                @else
                    <p style="color: #9ca3af; font-size: 14px;">Address details not available.</p>
                @endif
            </div>
        </div>

    </div>

    @include('components.usable.footer')

</div>

@endsection
