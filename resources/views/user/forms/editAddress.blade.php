@extends('layouts.allUser')

@section('userContent')

<div class="profile_container">

    <div class="profile_card">
        <div class="profile_right" style="width:100%">

            <h3 class="form_title">Edit Address <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1f1f1f"><path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h357l-80 80H200v560h560v-278l80-80v358q0 33-23.5 56.5T760-120H200Zm280-360ZM360-360v-170l367-367q12-12 27-18t30-6q16 0 30.5 6t26.5 18l56 57q11 12 17 26.5t6 29.5q0 15-5.5 29.5T897-728L530-360H360Zm481-424-56-56 56 56ZM440-440h56l232-232-28-28-29-28-231 231v57Zm260-260-29-28 29 28 28 28-28-28Z"/></svg></h3>

            <form method="POST" action="{{ route('user.address.update', $address->id) }}">
                @csrf

                <div class="form_grid">

                    <div class="form_group">
                        <label>Full Name</label>
                        <input type="text" name="full_name" value="{{ $address->full_name }}">
                    </div>

                    <div class="form_group">
                        <label>Mobile</label>
                        <input type="text" name="mobile" value="{{ $address->mobile }}">
                    </div>

                    <div class="form_group">
                        <label>Alternate</label>
                        <input type="text" name="alternate_mobile" value="{{ $address->alternate_mobile }}">
                    </div>

                    <div class="form_group full">
                        <label>Address</label>
                        <textarea name="address_line">{{ $address->address_line }}</textarea>
                    </div>

                    <div class="form_group">
                        <label>City</label>
                        <input type="text" name="city" value="{{ $address->city }}">
                    </div>

                    <div class="form_group">
                        <label>State</label>
                        <input type="text" name="state" value="{{ $address->state }}">
                    </div>

                    <div class="form_group">
                        <label>Pincode</label>
                        <input type="text" name="pincode" value="{{ $address->pincode }}">
                    </div>

                    <div class="form_group">
                        <label>Landmark</label>
                        <input type="text" name="landmark" value="{{ $address->landmark }}">
                    </div>

                    <div class="form_group">
                        <label>Type</label>
                        <select name="type" class="address_type_select">
                            <option value="home" {{ $address->type == 'home' ? 'selected' : '' }}>Home</option>
                            <option value="work" {{ $address->type == 'work' ? 'selected' : '' }}>Work</option>
                        </select>
                    </div>

                </div>

                <button class="btn_primary">Update Address</button>

            </form>

        </div>
    </div>

</div>

@endsection