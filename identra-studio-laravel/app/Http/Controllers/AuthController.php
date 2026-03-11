<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // POST /api/register
    public function register(Request $request)
    {
        $request->validate([
            'Email'    => 'required|email|max:50|unique:users,Email',
            'Nama'     => 'required|string|max:50',
            'Password' => 'required|string|min:6|max:12',
        ]);

        $user = User::create([
            'Email'    => $request->Email,
            'Nama'     => $request->Nama,
            'Password' => Hash::make($request->Password),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Registrasi berhasil',
            'token'   => $token,
            'user'    => $user,
        ], 201);
    }

    // POST /api/login
    public function login(Request $request)
    {
        $request->validate([
            'Email'    => 'required|email',
            'Password' => 'required|string',
        ]);

        $user = User::where('Email', $request->Email)->first();

        if (! $user || ! Hash::check($request->Password, $user->Password)) {
            throw ValidationException::withMessages([
                'Email' => ['Email atau Password salah.'],
            ]);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'Login berhasil',
            'token'   => $token,
            'user'    => $user,
        ]);
    }

    // POST /api/logout
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json(['message' => 'Logout berhasil']);
    }

    // GET /api/me
    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}
