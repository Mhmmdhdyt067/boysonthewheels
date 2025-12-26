<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // 1. Tampilkan Halaman Login
    public function index()
    {
        return view('auth.login');
    }

    // 2. Proses Login
    public function authenticate(Request $request)
    {
        // Validasi input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Coba Login (Laravel otomatis hash & cek password)
        // $request->boolean('remember') akan true jika checkbox dicentang
        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            // Security: Regenerate session ID untuk mencegah Session Fixation attack
            $request->session()->regenerate();

            // Redirect ke halaman yang dituju user sebelumnya, atau default ke dashboard
            return redirect()->intended('dashboard');
        }

        // Jika Gagal Login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    // 3. Proses Logout
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate session demi keamanan
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
