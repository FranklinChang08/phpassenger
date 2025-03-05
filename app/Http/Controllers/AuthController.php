<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pengguna;
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

    public function login(Request $request)
    {
        try {
            $credentials = $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();

                $user = Auth::user();
                $request->session()->put('user', $user); // Simpan data pengguna ke session

                if ($user->role === 'Admin') {
                    return redirect()->route('dashboard')->with('success', 'Welcome Admin!');
                } elseif ($user->role === 'Penumpang') {
                    return redirect()->route('home')->with('success', 'Welcome Customer!');
                }

                return redirect()->route('login')->with('error', 'Unauthorized access.');
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Login Failed');
        }

    }

    public function register(Request $request)
    {
        try {
            $validateData = $request->validate([
                'nama' => 'required|string|max:100',
                'email' => 'required|string|max:100|email|unique:Pengguna',
                'nomor_telepon' => 'required|string|max:15',
                'password' => 'required|string|min:8',
            ]);

            Pengguna::create([
                'nama' => $validateData['nama'],
                'email' => $validateData['email'],
                'nomor_telepon' => $validateData['nomor_telepon'],
                'password' => Hash::make($validateData['password']),
            ]);
            return redirect()->route('login')->with('success', 'data pengguna berhasil ditambahkan');
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'data pengguna gagal ditambahkan'. $e->getMessage());
        }
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login')->with('success', 'Logout Berhasil');
    }
}
