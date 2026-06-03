<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User; 
use Illuminate\Support\Facades\Hash; 
use Illuminate\Validation\ValidationException; 

class AuthController extends Controller
{
    public function register(Request $req)
    {
        // 1. Validasi Input Data
        $validated = $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        // 2. Simpan User Baru ke Database
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            // role otomatis ter-set 'user' sesuai default migration kamu
        ]);

        // 3. Buat Token Sanctum
        $token = $user->createToken('api-token')->plainTextToken;

        // 4. Return Response Sukses
        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user, 
                'token' => $token
            ],
            'message' => 'User registered'
        ], 201);
    }

    public function login(Request $req)
    {
        // 1. Validasi Input Login
        $req->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // 2. Cari User Berdasarkan Email
        $user = User::where('email', $req->email)->first();

        // 3. Cek Kecocokan User dan Password
        if (!$user || !Hash::check($req->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.']
            ]);
        }

        // 4. Hapus Token Lama (Opsional, agar token tidak menumpuk)
        $user->tokens()->delete();

        // 5. Buat Token Baru
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'status' => 'success',
            'data' => [
                'user' => $user, 
                'token' => $token
            ],
            'message' => 'User logged in'
        ]);
    }
}