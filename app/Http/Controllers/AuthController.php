<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable', 'boolean'],
        ]);

        if (Auth::attempt([
            'email'    => $validated['email'],
            'password' => $validated['password'],
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/admin');
        }

        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Auth::login($user);

        return redirect('/admin');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . Auth::id()],
        ]);

        $user = Auth::user();
        $user->name  = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function password(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'string'],
            'password'         => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['current_password'], $user->password)) {
            return back()->withErrors([
                'current_password' => 'The current password is incorrect.',
            ], 'updatePassword');
        }

        $user->password = Hash::make($validated['password']);
        $user->save();

        return redirect()->back()->with('success', 'Password updated successfully');
    }

    public function logoutOthers(Request $request)
    {
        $validated = $request->validateWithBag('logoutOthers', [
            'confirmSessionPassword' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['confirmSessionPassword'], $user->password)) {
            return back()->withErrors([
                'confirmSessionPassword' => 'The current password is incorrect.',
            ], 'logoutOthers');
        }

        Auth::logoutOtherDevices($validated['confirmSessionPassword']);
        return back()->with('success', 'Logged out from all other devices successfully');
    }

    public function deleteAccount(Request $request)
    {
        $validated = $request->validateWithBag('deleteAccount', [
            'confirmDeletePassword' => ['required', 'string'],
        ]);

        $user = Auth::user();

        if (!Hash::check($validated['confirmDeletePassword'], $user->password)) {
            return back()->withErrors([
                'confirmDeletePassword' => 'The current password is incorrect.',
            ], 'deleteAccount');
        }

        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Your account has been deleted');
    }
}
