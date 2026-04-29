<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function showLogin() { return view('login'); }
    public function showRegister() { return view('register'); }

    public function register(Request $request)
    {
        $request->validate([
            'Nama'     => 'required|string|max:50',
            'Email'    => 'required|email|max:50|unique:users,Email',
            'Password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'Nama'     => $request->Nama,
            'Email'    => $request->Email,
            'Password' => Hash::make($request->Password),
        ]);

       return redirect()->route('login')->with('success', 'Registrasi berhasil! Silakan masuk menggunakan akun baru Anda.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'Email'    => 'required|email',
            'Password' => 'required|string',
        ]);

        // Laravel Auth secara default mencari key 'password' (kecil), 
        // tapi kita arahkan ke kolom 'Email' dan input 'Password'
        if (Auth::attempt(['Email' => $credentials['Email'], 'password' => $credentials['Password']], $request->remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'Email' => 'Email atau Password yang anda masukkan salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}