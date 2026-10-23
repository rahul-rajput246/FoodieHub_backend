<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp,gif|max:5120',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        
        if($request->hasFile('image')){
            $image = $request->file('image');
            $uploadDir = public_path('assets/images');
            if(!file_exists($uploadDir)){
                @mkdir($uploadDir, 0777, true);
            }

            $storageDir = storage_path('app/public/assets/images');
            if(!file_exists($storageDir)){
                @mkdir($storageDir, 0777, true);
            }

            $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $image->getClientOriginalName());

            $image->move($uploadDir, $imageName);
            @copy($uploadDir . '/' . $imageName, $storageDir . '/' . $imageName);

            $user->user_image = 'assets/images/' . $imageName;
        }

        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = auth()->user();

        // check current password
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Current password is incorrect');
        }

        // update password
        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password updated successfully');
    }

    public function saveAddress(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'required|digits:10',
            'address_line' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|digits:6',
        ]);

        UserAddress::create([
            'user_id' => auth()->id(),
            'full_name' => $request->full_name,
            'mobile' => $request->mobile,
            'alternate_mobile' => $request->alternate_mobile,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'landmark' => $request->landmark,
            'type' => $request->type,
        ]);

        return back()->with('success', 'Address added successfully');
    }

    public function updateAddress(Request $request, $id)
    {
        $request->validate([
            'full_name' => 'required',
            'mobile' => 'required|digits:10',
            'address_line' => 'required',
            'city' => 'required',
            'state' => 'required',
            'pincode' => 'required|digits:6',
        ]);

        $address = UserAddress::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $address->update([
            'full_name' => $request->full_name,
            'mobile' => $request->mobile,
            'alternate_mobile' => $request->alternate_mobile,
            'address_line' => $request->address_line,
            'city' => $request->city,
            'state' => $request->state,
            'pincode' => $request->pincode,
            'landmark' => $request->landmark,
            'type' => $request->type ?? 'home',
        ]);

        return redirect()->route('user.profile')->with('success', 'Address updated successfully');
    }

    public function editAddress($id)
    {
        $address = UserAddress::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        return view('user.forms.editAddress', compact('address'));

    }

    public function deleteAddress($id)
    {
        $address = UserAddress::where('id', $id)
            ->where('user_id', auth()->id())
            ->firstOrFail();

        $address->delete();

        return back()->with('success', 'Address deleted successfully');
    }

}
