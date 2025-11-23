<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Show login form
     */
    public function showLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $credentials['username'])->first();

        // Validasi password
        if ($user && password_verify($credentials['password'], $user->password)) {
            // Login user
            Auth::login($user);
            $request->session()->regenerate();

            // Redirect ke dashboard berdasarkan role
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard')->with('success', 'Login berhasil');
            } else {
                return redirect()->route('home')->with('success', 'Login berhasil');
            }
        }

        // Jika login gagal
        return back()
            ->withInput($request->only('username'))
            ->withErrors(['message' => 'Username atau password salah']);
    }

    /**
     * Handle logout
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logout berhasil');
    }
}
