@extends('layouts.allAdmin')

@section('content')

<div class="main_dashboard">

    <div class="dashboard_header">
        <div class="dashboard_header_left">
            <p class="dashboard_small_text">Account Settings</p>
            <h1>My Profile & Addresses</h1>
            <p class="dashboard_desc">Manage your account details, security credentials, and delivery addresses.</p>
        </div>

        <div class="dashboard_header_right">
            <a href="/admin/dashboard" class="dashboard_top_btn" style="background: #374151;">Dashboard</a>
            <a href="/orders" class="dashboard_top_btn">My Orders</a>
        </div>
    </div>

    @if(session('success'))
        <div style="background: #dcfce7; border: 1px solid #86efac; color: #166534; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px; font-weight: 500;">
            {{ session('error') }}
        </div>
    @endif

    @if ($errors->any())
        <div style="background: #fee2e2; border: 1px solid #fca5a5; color: #991b1b; padding: 14px 18px; border-radius: 12px; margin-bottom: 20px;">
            <ul style="margin: 0; padding-left: 20px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="page_form_card" style="margin-bottom: 25px;">

        <!-- UPDATE PROFILE -->
        <div class="main_form_box">
            <div class="form_card_title_row">
                <h3>Update Profile</h3>
                <p>Edit your name, email, and display avatar.</p>
            </div>

            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf

                <div class="form_group">
                    <label>Full Name</label>
                    <input type="text" value="{{ Auth::user()->name }}" name="name" required>
                </div>

                <div class="form_group">
                    <label>Email Address</label>
                    <input type="email" value="{{ Auth::user()->email }}" name="email" required>
                </div>

                <div class="form_group">
                    <label>Profile Image</label>
                    <input type="file" name="image">
                    @if(Auth::user()->user_image)
                        <div style="margin-top: 10px;">
                            <img src="{{ asset('storage/' . Auth::user()->user_image) }}" alt="Avatar" style="width: 50px; height: 50px; border-radius: 50%; object-fit: cover;">
                        </div>
                    @endif
                </div>

                <button type="submit" class="save_page_btn">Save Profile Changes</button>
            </form>
        </div>

        <!-- CHANGE PASSWORD -->
        <div class="main_form_box">
            <div class="form_card_title_row">
                <h3>Change Password</h3>
                <p>Ensure your account is using a secure password.</p>
            </div>

            <form method="POST" action="{{ route('user.password.update') }}">
                @csrf

                <div class="form_group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required placeholder="Enter current password">
                </div>

                <div class="form_group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required placeholder="Enter new password">
                </div>

                <div class="form_group">
                    <label>Confirm New Password</label>
                    <input type="password" name="new_password_confirmation" required placeholder="Confirm new password">
                </div>

                <button type="submit" class="save_page_btn">Update Password</button>
            </form>
        </div>

    </div>

    <!-- SAVED ADDRESSES -->
    <div class="main_form_box" style="margin-bottom: 30px;">
        <div class="form_card_title_row">
            <h3>Saved Delivery Addresses</h3>
            <p>Manage your delivery locations for faster checkout.</p>
        </div>

        @if(Auth::user()->addresses && Auth::user()->addresses->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 16px; margin-bottom: 30px;">
                @foreach(Auth::user()->addresses as $address)
                    <div style="background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 14px; padding: 18px; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px;">
                                <strong style="font-size: 15px; color: #111827;">{{ $address->full_name }}</strong>
                                <span style="background: #e5e7eb; color: #374151; font-size: 11px; padding: 2px 8px; border-radius: 6px; text-transform: uppercase; font-weight: 600;">
                                    {{ $address->type ?? 'Home' }}
                                </span>
                            </div>
                            <p style="font-size: 13px; color: #4b5563; margin-bottom: 4px;">📞 {{ $address->mobile }}</p>
                            <p style="font-size: 13px; color: #4b5563; margin-bottom: 4px;">{{ $address->address_line }}</p>
                            <p style="font-size: 13px; color: #6b7280;">{{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}</p>
                        </div>

                        <div style="margin-top: 14px; display: flex; gap: 8px; border-top: 1px solid #e5e7eb; padding-top: 10px;">
                            <a href="{{ route('user.address.edit', $address->id) }}" class="action_btn edit_btn" style="padding: 6px 12px; font-size: 12px;">Edit</a>
                            <a href="{{ route('user.address.delete', $address->id) }}" onclick="return confirm('Delete this address?')" class="action_btn delete_btn" style="padding: 6px 12px; font-size: 12px;">Delete</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p style="color: #6b7280; font-size: 14px; margin-bottom: 25px;">No saved addresses yet. Add an address below.</p>
        @endif

        <div class="form_card_title_row" style="margin-top: 20px;">
            <h3>Add New Address</h3>
            <p>Provide accurate details for fast doorstep delivery.</p>
        </div>

        <form method="POST" action="{{ route('user.address.save') }}">
            @csrf

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 16px;">
                <div class="form_group">
                    <label>Full Name</label>
                    <input type="text" name="full_name" required placeholder="Receiver name">
                </div>

                <div class="form_group">
                    <label>Mobile Number</label>
                    <input type="text" name="mobile" required placeholder="10-digit mobile number">
                </div>

                <div class="form_group">
                    <label>Alternate Mobile (Optional)</label>
                    <input type="text" name="alternate_mobile" placeholder="Alternative contact">
                </div>

                <div class="form_group">
                    <label>Address Type</label>
                    <select name="type" style="width: 100%; border: 1px solid #d1d5db; border-radius: 12px; padding: 13px 15px; font-size: 14px; outline: none; background: #fff;">
                        <option value="home">Home</option>
                        <option value="work">Work</option>
                    </select>
                </div>

                <div class="form_group" style="grid-column: span 2;">
                    <label>Street Address / Flat / Building</label>
                    <textarea name="address_line" rows="3" required placeholder="Enter complete street address"></textarea>
                </div>

                <div class="form_group">
                    <label>City</label>
                    <input type="text" name="city" required placeholder="City name">
                </div>

                <div class="form_group">
                    <label>State</label>
                    <input type="text" name="state" required placeholder="State">
                </div>

                <div class="form_group">
                    <label>Pincode</label>
                    <input type="text" name="pincode" required placeholder="6-digit pincode">
                </div>

                <div class="form_group">
                    <label>Landmark (Optional)</label>
                    <input type="text" name="landmark" placeholder="Nearby landmark">
                </div>
            </div>

            <button type="submit" class="save_page_btn" style="margin-top: 15px;">Save New Address</button>
        </form>
    </div>

    @include('components.usable.footer')

</div>

@endsection