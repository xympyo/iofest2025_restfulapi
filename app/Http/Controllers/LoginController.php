<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required_without:email', 'string'],
            'email' => ['required_without:username', 'email'],
            'password' => ['required', 'string'],
        ]);

        // Allow login with either username or email
        $login_type = filter_var($request->input('username') ?? $request->input('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        $login_value = $request->input($login_type);

        $auth = auth()->attempt([
            $login_type => $login_value,
            'password' => $request->input('password'),
        ]);

        if ($auth) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('username', 'email'));
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}

