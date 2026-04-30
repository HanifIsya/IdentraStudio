<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'Nama' => 'required|string|max:50',
            'Email' => 'required|email|unique:users,Email',
            'Password' => 'required|min:6',
        ]);

        User::create([
            'Nama' => $request->Nama,
            'Email' => $request->Email,
            'Password' => Hash::make($request->Password),
            'role' => 'user', // Default saat mendaftar adalah user
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan login.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Email' => 'required|email',
            'Password' => 'required',
        ]);

        // Mencoba login
        if (Auth::attempt(['Email' => $credentials['Email'], 'password' => $credentials['Password']], $request->remember)) {
            $request->session()->regenerate();

            // LOGIKA PENGALIHAN BERDASARKAN ROLE
            if (Auth::user()->role === 'admin') {
                // Jika admin, arahkan ke dashboard admin
                return redirect()->intended('/admin/dashboard');
            }

            // Jika bukan admin (user biasa), arahkan ke dashboard user
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'Email' => 'Email atau Password yang Anda masukkan salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}