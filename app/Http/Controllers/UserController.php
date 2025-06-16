<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function edit($id_akun)
    {
        $user = User::findOrFail($id_akun);
        return response()->json($user);
    }

    public function update(Request $request, $id_akun)
    {
        $user = User::findOrFail($id_akun);

        $validated = $request->validate([
            'username' => 'required|string|max:15',
            'email' => 'required|email|max:255',
            'no_telp' => 'nullable|string|max:15',
        ]);

        $user->username = $validated['username'];
        $user->email = $validated['email'];
        $user->no_telp = $validated['no_telp'];

        $user->save();

        return response()->json(['message' => 'Profile has been updated successfully!']);
    }

    public function changePassword(Request $request, $id_akun)
    {
        $user = User::findOrFail($id_akun);

        // dd('Auth ID:', Auth::id(), 'User ID:', $user->id_akun);

        if (Auth::id() !== $user->id_akun) {
            return response()->json(['message' => 'You are not authorized to change this password.'], 403);
        }

        $request->validate([
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ],
        [
            'password.confirmed' => 'Make sure the new password and password confirmation match.',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['The provided password does not match your current password.'],
            ]);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json(['message' => 'Password has been updated successfully!']);
    }
}
