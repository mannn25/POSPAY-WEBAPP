<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.login.index');
    }

    public function login_proses(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            // Jika login berhasil
            return redirect('/dashboard');
        }

        // Jika login gagal, kembali dengan pesan error umum
        return redirect('/')->with([
            'failed' => 'Username atau Password Salah'
        ]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/')->with('success', 'Kamu berhasil logout');
    }
}
