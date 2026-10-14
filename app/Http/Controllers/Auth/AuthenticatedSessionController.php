<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        $redirect = $request->input('redirect');
        $validRedirect = null;
        if ($redirect && (
            str_starts_with($redirect, 'http://localhost:5173') ||
            str_starts_with($redirect, 'http://127.0.0.1:5173') ||
            str_starts_with($redirect, 'https://foodie-hub-alpha.vercel.app') ||
            str_starts_with($redirect, '/')
        )) {
            $validRedirect = $redirect;
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'roles' => $user->getRoleNames(),
                ],
                'redirect' => $validRedirect ?: '/admin/dashboard',
            ]);
        }

        return $validRedirect ? redirect()->away($validRedirect) : redirect('/admin/dashboard');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }
    
}
