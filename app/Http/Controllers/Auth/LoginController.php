<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            $user = Auth::user();

            // ✅ ADMIN
            if ($user->role->name == 'admin') {
                return redirect()->route('welcome');
            }

            // ✅ KARYAWAN
            if ($user->role->name == 'karyawan') {
                return redirect()->route('barang.index');
            }

            // ✅ KASIR (INI YANG KAMU BUTUH 🔥)
            if ($user->role->name == 'kasir') {
                return redirect()->route('kasir.index');
            }

            // default fallback
            return redirect()->route('welcome');
        }

        return back()->with('error','Email atau password salah');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}