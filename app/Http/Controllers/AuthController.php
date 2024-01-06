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
                    return redirect()->intended(UserStatus::ADMIN->route());
                    break;
                case UserStatus::PIMPINAN:
                    return redirect()->intended(UserStatus::PIMPINAN->route());
                    break;
                case UserStatus::PEGAWAI:
                    return redirect()->intended(UserStatus::PEGAWAI->route());
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

    public function gantiPasswordHalaman()
    {
        return view('dashboard.ganti-password');
    }

    public function gantiPassword(Request $request)
    {
        $validatedData = $request->validate([
            'password_baru'             => 'required',
            'password_baru_konfirmasi'  => 'required'
        ]);

        if ($validatedData['password_baru'] !== $validatedData['password_baru_konfirmasi'])
            return redirect('/ganti-password')->with('failed', 'Password baru tidak cocok.');

        Auth::user()->update(['password' => $validatedData['password_baru']]);

        return redirect('/ganti-password')->with('success', 'Berhasil ganti password.');
    }
}
