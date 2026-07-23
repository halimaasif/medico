<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    // 1. Login Form Show Karna
    public function showLoginForm()
    {
        // Failsafe: Agar auth.login folder me mile toh wo load kare, warna direct wala load kare
        if (View::exists('auth.login')) {
            return view('auth.login');
        }
        return view('login');
    }

    // 2. Register Form Show Karna
    public function showRegisterForm()
    {
        // Failsafe: Agar auth.register folder me mile toh wo load kare, warna direct wala load kare
        if (View::exists('auth.register')) {
            return view('auth.register');
        }
        return view('register');
    }

    // 3. User Registration Logic
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255|unique:users', 
            'email'    => 'required|string|email|max:255|unique:users',
            'phone'    => 'required|string|max:20',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        return redirect()->route('symptoms.index');
    }

    // 4. User Login Logic
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name'     => 'required|string',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('symptoms.index');
        }

        return back()->withErrors([
            'name' => 'The provided name or password does not match our records.',
        ])->withInput($request->only('name'));
    }

    // 5. Logout Logic
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('login');
    }
}