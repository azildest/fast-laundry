<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        $loginField = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

        $credentials = [
            $loginField => $request->input('login'),
            'password' => $request->input('password'),
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->level == 2) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->level == 1) {
                return redirect()->intended('/admin/dashboard');
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'login' => ['Invalid user level.'],
                ]);
            }
        }

        throw ValidationException::withMessages([
            'login' => ['Invalid credentials.'],
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}