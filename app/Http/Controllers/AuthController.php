<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

/**
 * AuthController
 * Mengatur proses login & logout admin
 */
class AuthController extends Controller
{
    /**
     * Tampilkan form login
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Proses login
     */
    public function login(Request $request)
    {
        // validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // ambil user berdasarkan email
        $user = DB::table('users')
            ->where('email', $request->email)
            ->first();

        // cek user & password
        if ($user && Hash::check($request->password, $user->password)) {

            // simpan session login
            Session::put('login', true);
            Session::put('user_id', $user->id);
            Session::put('user_name', $user->name);
            Session::put('role', $user->role);

            return redirect('/training');
        }

        // gagal login
        return back()->with('error', 'Email atau password salah');
    }

    /**
     * Logout
     */
    public function logout()
    {
        Session::flush();
        return redirect('/login');
    }
}
