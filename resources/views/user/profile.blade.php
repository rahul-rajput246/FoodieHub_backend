@extends('layouts.allUser')

@section('userContent')

<div class="profile_container">

    <!-- TOP HEADER -->
    <div class="dashboard_top modern_top">
        <div>
            <h2>My Profile </h2>
            <p>Update your account's profile information and email address.</p>
        </div>
    </div>

    <!-- PROFILE CARD -->
    <div class="profile_card">

        <!-- RIGHT -->
        <div class="profile_right">

            <h3 class="form_title">Update Profile</h3>

            <form method="POST" action="{{ route('user.profile.update') }}" enctype="multipart/form-data">
                @csrf

                @if(session('success'))
                    <div class="alert_success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert_error">{{ session('error') }}</div>
                @endif

                @if ($errors->any())
                    <div class="alert_error">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <div class="form_group">
                    <label>Name</label>
                    <input type="text" value="{{ Auth::user()->name }}" name="name">
                </div>

                <div class="form_group">
                    <label>Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" name="email">
                </div>

                <div class="form_group">
                    <label>Profile Image</label>
                    <input type="file" name="image">
                </div>

                <button class="btn_primary">Update Profile</button>

            </form>

        </div>

    </div>

    <div class="profile_card">

        <div class="profile_right" style="width:100%">

            <h3 class="form_title">Change Password <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M420-360h120l-23-129q20-10 31.5-29t11.5-42q0-33-23.5-56.5T480-640q-33 0-56.5 23.5T400-560q0 23 11.5 42t31.5 29l-23 129Zm60 280q-139-35-229.5-159.5T160-516v-244l320-120 320 120v244q0 152-90.5 276.5T480-80Zm0-84q104-33 172-132t68-220v-189l-240-90-240 90v189q0 121 68 220t172 132Zm0-316Z"/></svg></h3>

            <form method="POST" action="{{ route('user.password.update') }}">
                @csrf

                <div class="form_group">
                    <label>Current Password</label>
                    <input type="password" name="current_password" required>
                </div>

                <div class="form_group">
                    <label>New Password</label>
                    <input type="password" name="new_password" required>
                </div>

                <div class="form_group">
                    <label>Confirm Password</label>
                    <input type="password" name="new_password_confirmation" required>
                </div>

                <button class="btn_primary">Update Password</button>

            </form>

        </div>

    </div>

    <div class="profile_card">

        <div class="profile_right" style="width:100%">

        <h3 class="form_title">My Addresses <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-200v-200h240v200-200H200v200Zm480-360ZM40-120v-400l280-200 280 200-28.5 28.5L543-463 320-622 120-480v280h80v-200h240v280h-80v-200h-80v200H40Zm880-720v405q-17-18-37-32.5T840-493v-267H480v56l-80-58v-78h520ZM680-600h80v-80h-80v80Zm40 560q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Zm-20-80h40v-100h100v-40H740v-100h-40v100H600v40h100v100Z"/></svg></h3>

        @foreach(Auth::user()->addresses as $address)
            <div class="address_card">
                <div class="address_details">
                    <strong>{{ $address->full_name }}</strong>
                    <p>{{ $address->address_line }}</p>
                    <p>{{ $address->city }}, {{ $address->state }} - {{ $address->pincode }}</p>
                    <p class="contact_no"><svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M80-120q-33 0-56.5-23.5T0-200v-560q0-33 23.5-56.5T80-840h800q33 0 56.5 23.5T960-760v560q0 33-23.5 56.5T880-120H80Zm556-80h244v-560H80v560h4q42-75 116-117.5T360-360q86 0 160 42.5T636-200ZM445-435q35-35 35-85t-35-85q-35-35-85-35t-85 35q-35 35-35 85t35 85q35 35 85 35t85-35Zm315 195 80-80-60-80h-66q-6-18-10-38.5t-4-41.5q0-21 4-40.5t10-39.5h66l60-80-80-80q-54 42-87 106.5T640-480q0 69 33 133.5T760-240Zm-578 40h356q-34-38-80.5-59T360-280q-51 0-97 21t-81 59Zm149.5-291.5Q320-503 320-520t11.5-28.5Q343-560 360-560t28.5 11.5Q400-537 400-520t-11.5 28.5Q377-480 360-480t-28.5-11.5ZM480-480Z"/></svg> {{ $address->mobile }}</p>
                </div>

                <div class="address_actions">

                    <!-- EDIT BUTTON -->
                    <a href="{{ route('user.address.edit', $address->id) }}" class="btn_edit">
                        Edit
                    </a>

                    <!-- DELETE BUTTON -->
                    <a href="{{ route('user.address.delete', $address->id) }}"
                    onclick="return confirm('Delete this address?')"
                    class="btn_delete">
                        Delete
                    </a>

                </div>

            </div>
        @endforeach

            <h3 class="form_title" style="margin-top:10px">Add Address <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-200v-200h240v200-200H200v200Zm480-360ZM40-120v-400l280-200 280 200-28.5 28.5L543-463 320-622 120-480v280h80v-200h240v280h-80v-200h-80v200H40Zm880-720v405q-17-18-37-32.5T840-493v-267H480v56l-80-58v-78h520ZM680-600h80v-80h-80v80Zm40 560q-83 0-141.5-58.5T520-240q0-83 58.5-141.5T720-440q83 0 141.5 58.5T920-240q0 83-58.5 141.5T720-40Zm-20-80h40v-100h100v-40H740v-100h-40v100H600v40h100v100Z"/></svg></h3>

            <form method="POST" action="{{ route('user.address.save') }}">
                @csrf

                 <input type="hidden" name="address_id" id="address_id">

                <div class="form_grid">

                    <div class="form_group">
                        <label>Full Name</label>
                        <input type="text" name="full_name">
                    </div>

                    <div class="form_group">
                        <label>Mobile Number</label>
                        <input type="text" name="mobile">
                    </div>

                    <div class="form_group">
                        <label>Alternate Number</label>
                        <input type="text" name="alternate_mobile">
                    </div>

                    <div class="form_group full">
                        <label>Address</label>
                        <textarea name="address_line"></textarea>
                    </div>

                    <div class="form_group">
                        <label>City</label>
                        <input type="text" name="city">
                    </div>

                    <div class="form_group">
                        <label>State</label>
                        <input type="text" name="state">
                    </div>

                    <div class="form_group">
                        <label>Pincode</label>
                        <input type="text" name="pincode">
                    </div>

                    <div class="form_group">
                        <label>Landmark</label>
                        <input type="text" name="landmark">
                    </div>

                    <div class="form_group">
                        <label>Address Type</label>
                        <select name="type" class="address_type_select">
                            <option value="home">Home</option>
                            <option value="work">Work</option>
                        </select>
                    </div>

                </div>

                <button class="btn_primary">Save Address</button>

            </form>

        </div>

    </div>

</div>

@endsection