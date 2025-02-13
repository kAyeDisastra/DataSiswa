<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
    
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Cek apakah role user adalah admin atau user biasa
            if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard')->with('status', 'Selamat datang Admin!');
            } else {
                return redirect()->route('user.dashboard')->with('status', 'Selamat datang User!');
            }
        } else {
            return redirect()->route('login')->with('error', 'Email atau password salah.');
        }
    }

    public function logout(Request $request)
    {
        // Ambil informasi role user sebelum logout
        $user = Auth::user();
        
        // Logout dan reset session
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect berdasarkan role
        if ($user && $user->role == 'admin') {
            return redirect()->route('login')->with('status', 'Anda telah logout sebagai Admin.');
        } else {
            return redirect()->route('login')->with('status', 'Anda telah logout sebagai User.');
        }
    }
}
