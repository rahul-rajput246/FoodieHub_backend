@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">Account Settings</p>
            <h1>Edit Delivery Address</h1>
            <p class="dashboard_desc">Update your address details for future orders and deliveries.</p>
        </div>

        <div class="dashboard_header_right">
            <a href="{{ route('user.profile') }}" class="dashboard_top_btn" style="background: #374151;">← Back to Profile</a>
        </div>
    </div>

    <div class="main_form_box" style="max-width: 800px; margin: 0 auto 30px;">
        <div class="form_card_title_row">
            <h3>Update Address Information</h3>
            <p>Ensure receiver name and contact details are accurate.</p>
        </div>

        <form method="POST" action="{{ route('user.address.update', $address->id) }}">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                <div class="form_group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" value="{{ $address->full_name }}" required>
                </div>

                <div class="form_group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" value="{{ $address->mobile }}" required>
                </div>

                <div class="form_group">
                    <label>Alternate Mobile (Optional)</label>
                    <input type="text" name="alternate_mobile" value="{{ $address->alternate_mobile }}">
                </div>

                <div class="form_group">
                    <label>Address Type</label>
                    <select name="type" style="width: 100%; border: 1px solid #d1d5db; border-radius: 12px; padding: 13px 15px; font-size: 14px; outline: none; background: #fff;">
                        <option value="home" {{ $address->type == 'home' ? 'selected' : '' }}>Home</option>
                        <option value="work" {{ $address->type == 'work' ? 'selected' : '' }}>Work</option>
                    </select>
                </div>

                <div class="form_group" style="grid-column: span 2;">
                    <label>Street Address / Flat / Building</label>
                    <textarea name="address_line" rows="3" required>{{ $address->address_line }}</textarea>
                </div>

                <div class="form_group">
                    <label>City</label>
                    <input type="text" name="city" value="{{ $address->city }}" required>
                </div>

                <div class="form_group">
                    <label>State</label>
                    <input type="text" name="state" value="{{ $address->state }}" required>
                </div>

                <div class="form_group">
                    <label>Pincode</label>
                    <input type="text" name="pincode" value="{{ $address->pincode }}" required>
                </div>

                <div class="form_group">
                    <label>Landmark (Optional)</label>
                    <input type="text" name="landmark" value="{{ $address->landmark }}">
                </div>
            </div>

            <div style="display: flex; gap: 12px; margin-top: 15px;">
                <button type="submit" class="save_page_btn">Update Address</button>
                <a href="{{ route('user.profile') }}" class="dashboard_top_btn" style="background: #9ca3af; text-decoration: none; padding: 14px 20px;">Cancel</a>
            </div>
        </form>
    </div>

    @include('components.usable.footer')

</div>

@endsection