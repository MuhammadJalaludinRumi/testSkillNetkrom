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
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Jika user adalah admin, arahkan ke halaman admin
            if ($user->is_admin) {
                return redirect()->route('admin.konser.index');
            }

            // Jika bukan admin, arahkan ke beranda user
            return redirect()->route('beranda');
        }

        return back()->with('error', 'Email atau Password salah');
    }


    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => false,
        ]);

        return redirect('/login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function dashboard()
    {
        if (Auth::user()->is_admin) {
            return redirect()->route('admin.konser.index');
        }

        return redirect()->route('beranda');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
