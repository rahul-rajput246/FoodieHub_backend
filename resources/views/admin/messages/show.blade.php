@extends('layouts.allAdmin')

@section('content')

<div class="main_allfood_container">

    <div class="pages_header allfood_header">
        <div>
            <p class="dashboard_small_text">Customer Inquiry</p>
            <h1>Message Details</h1>
            <p class="pages_desc">
                Received from {{ $message->name }} on {{ $message->created_at->format('d M Y, h:i A') }}
            </p>
        </div>

        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
            <a href="mailto:{{ $message->email }}?subject=Re:%20Inquiry%20at%20FoodieHub" class="create_food_btn" style="background: #2563eb;">
                ✉️ Reply via Email
            </a>
            @if(!empty($message->phone))
            <a href="tel:{{ $message->phone }}" class="create_food_btn" style="background: #059669;">
                📞 Call Customer
            </a>
            @endif
            <a href="{{ route('admin.messages.index') }}" class="create_food_btn" style="background: #374151;">
                ← Back to Inquiries
            </a>
        </div>
    </div>

    @if(session('success'))
        <div style="margin-bottom:20px; padding:12px 16px; background:#d1fae5; color:#065f46; border-radius:12px; font-weight: 500;">
            ✓ {{ session('success') }}
        </div>
    @endif

    <div class="order_info_grid">
        
        {{-- Sender Information --}}
        <div class="allfood_table_box">
            <div class="box_title_row">
                <h3>Customer Information</h3>
            </div>

            <div class="contact_det">
                <p><b>Name:</b> {{ $message->name }}</p>
                <p><b>Email:</b> <a href="mailto:{{ $message->email }}" style="color: #ff7e00; text-decoration: none;">{{ $message->email }}</a></p>
                <p><b>Phone:</b> {{ $message->phone ?? 'Not provided' }}</p>
                <p><b>Received On:</b> {{ $message->created_at->format('d M Y, h:i A') }} ({{ $message->created_at->diffForHumans() }})</p>
                <p><b>IP Address:</b> {{ $message->ip_address ?? 'N/A' }}</p>
            </div>
        </div>

        {{-- Status & Quick Actions --}}
        <div class="allfood_table_box">
            <div class="box_title_row">
                <h3>Update Inquiry Status</h3>
            </div>

            <div style="padding: 20px 0;">
                <form action="{{ route('admin.messages.status', $message->id) }}" method="POST">
                    @csrf
                    <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 20px;">
                        <label for="status" style="font-weight: 600; font-size: 14px; color: #374151;">Current Status</label>
                        <select name="status" id="status" class="custom_select">
                            <option value="unread" {{ $message->status == 'unread' ? 'selected' : '' }}>Unread</option>
                            <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Read</option>
                            <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Replied</option>
                        </select>
                    </div>

                    <button type="submit" class="create_food_btn" style="border:none; cursor:pointer;">
                        Update Status
                    </button>
                </form>

                <div style="margin-top: 25px; padding-top: 15px; border-top: 1px solid #f3f4f6;">
                    <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST" onsubmit="return confirm('Permanently delete this inquiry?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background: none; border: none; color: #dc2626; font-size: 13px; font-weight: 600; cursor: pointer; padding: 0;">
                            🗑️ Delete This Inquiry
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>

    {{-- Message Body --}}
    <div class="allfood_table_box" style="margin-bottom: 30px;">
        <div class="box_title_row">
            <h3>Message Content</h3>
        </div>

        <div style="padding: 24px 0; font-size: 15px; line-height: 1.8; color: #1f2937; white-space: pre-line;">
            {{ $message->message }}
        </div>
    </div>

    @include('components.usable.footer')

</div>

@endsection
