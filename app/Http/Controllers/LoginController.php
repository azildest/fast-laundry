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

        $remember = $request->boolean('remember');

        if (Auth::attempt($credentials, $remember)) {
            $user = Auth::user();

            // dd($user);

            if ($user->level == 2) {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->level == 1) {
                return redirect()->intended('/admin/dashboard');
            } else {
                Auth::logout();
                throw ValidationException::withMessages([
                    'login' => ['Invalid user.'],
                ]);
            }
        }

        // dd($request->all(), $credentials);
        // dd("Authentication failed. Credentials: ", $credentials);

        // throw ValidationException::withMessages([
        //     'login' => ['Invalid credentials.'],
        // ]);

        $userExists = \App\Models\User::where($loginField, $request->input('login'))->first();

        if (!$userExists) {
            throw ValidationException::withMessages([
                'login' => ['Email or username is not registered.'],
            ]);
        } else {
            throw ValidationException::withMessages([
                'password' => ['Password is incorrect.'],
            ]);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return $this->loggedOut($request) ?: redirect('login');
    }

    protected function loggedOut(Request $request)
    {
        return redirect('login')->with('status', 'You have been logged out.');
    }
}