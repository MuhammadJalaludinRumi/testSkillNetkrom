<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if (Auth::user()->is_admin) {
                return redirect()->intended(route('admin.pemesan.index'));

            } else {
                Auth::logout();
                return back()->with('error', 'Akses hanya untuk admin.');
            }
        }

        return back()->with('error', 'Email atau password salah.');
    }
}
