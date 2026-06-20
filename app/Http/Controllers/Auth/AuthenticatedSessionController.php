<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;

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
    public function store(LoginRequest $request): RedirectResponse
    {
        // 1. Jalankan proses cek email & password bawaan Breeze
        $request->authenticate();

        // 2. Ambil data user yang baru saja lolos otentikasi
        $user = Auth::user();

        // 3. Cek apakah user statusnya Nonaktif (is_active == false atau 0)
        if (!$user->is_active) {
            // Logout paksa karena akun diblokir/nonaktif
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            // Lemparkan error ke form login
            throw ValidationException::withMessages([
                'email' => 'Akun Anda telah dinonaktifkan oleh Admin.',
            ]);
        }

        // 4. Jika user AKTIF, lanjutkan proses session & redirect sesuai role
        $request->session()->regenerate();

        $role = $user->role ?? 'cashier';

        if (in_array($role, ['owner', 'manager', 'supervisor'])) {
            return redirect()->intended(route('dashboard', absolute: false));
        } elseif ($role === 'warehouse') {
            return redirect()->intended(route('inventory.index', absolute: false));
        }

        return redirect()->intended(route('pos', absolute: false));
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