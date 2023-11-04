<?php

namespace App\Http\Controllers;

use App\Enums\User\UserStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        if (Auth::attempt($data)) {
            $request->session()->regenerate();

            $user = Auth::user();
            switch ($user->status) {
                case UserStatus::ADMIN:
                    return redirect()->intended('/admin');
                    break;
                case UserStatus::PIMPIMAN:
                    return redirect()->intended('/pimpinan');
                    break;
                case UserStatus::PEGAWAI:
                    return redirect()->intended('/pegawai');
                    break;
            }
        }

        return redirect('/login')->with('failed', 'NIP atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
