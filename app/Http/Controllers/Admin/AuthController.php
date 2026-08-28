<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProfilKampung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (
            Auth::guard('web')->check() ||
            Auth::guard('subadmin')->check()
        ) {
            return redirect()->route('admin.dashboard');

        }
        $fotoLogin = ProfilKampung::get('foto_login');
        return view('admin.login', compact('fotoLogin'));
    }

    public function login(Request $request)
    {
        // 1. Validasi input (menggunakan nama field 'login' atau 'email')
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        $loginInput = $request->input('email');
        $password = $request->input('password');

        // 2. Cek apakah inputan berupa email atau username, lalu coba login ke guard 'web'
        // $webField = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $webField = 'email';
        if (Auth::guard('web')->attempt([$webField => $loginInput, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // 3. Coba login ke guard 'subadmin' (biasanya sub-admin menggunakan username)
        if (Auth::guard('subadmin')->attempt(['username' => $loginInput, 'password' => $password])) {
            $request->session()->regenerate();
            return redirect()->intended(route('admin.dashboard'));
        }

        // 4. Jika semuanya gagal
        return back()->withErrors(['email' => 'Email/Username atau password salah.'])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Auth::guard('subadmin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
