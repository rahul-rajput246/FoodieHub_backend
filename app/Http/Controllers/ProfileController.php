<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('user.profile', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->fill($request->validated());

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $uploadDir = public_path('assets/images');
            if (!file_exists($uploadDir)) {
                @mkdir($uploadDir, 0777, true);
            }
            $storageDir = storage_path('app/public/assets/images');
            if (!file_exists($storageDir)) {
                @mkdir($storageDir, 0777, true);
            }
            $imageName = time() . '_' . preg_replace('/[^a-zA-Z0-9_\.-]/', '_', $image->getClientOriginalName());
            $image->move($uploadDir, $imageName);
            @copy($uploadDir . '/' . $imageName, $storageDir . '/' . $imageName);
            $user->user_image = 'assets/images/' . $imageName;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
