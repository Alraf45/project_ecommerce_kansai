<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            return back()->withErrors([
                'email' => 'Email atau password salah.',
            ])->onlyInput('email');
        }

        $request->session()->regenerate();

        $user = Auth::user();
        $user->last_login = now();
        $user->save();

        // 🚀 Tambahkan session flash untuk notifikasi selamat datang
        session()->flash('just_logged_in', true);
        session()->flash('login_name', $user->name);

        // 🔹 Redirect berdasarkan role
        if ($user->admin) { // pastikan ada kolom is_admin di tabel users
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, Admin ' . $user->name . '!');
        }

        return redirect()->intended('/')->with('success', 'Berhasil login, ' . $user->name . '!');
    }

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // logout juga kasih pesan
        return redirect('/')
            ->with('success', 'Kamu telah logout.');
    }
}
