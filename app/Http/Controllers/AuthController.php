<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password as PasswordRule;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'remember' => ['nullable', 'boolean'],
        ]);

        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password'],
        ], $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect()->route('verification.notice');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.Auth::id()],
            'avatar' => ['nullable', 'string', 'max:255'],
        ]);

        $user = Auth::user();
        $user->name = $validated['name'];
        $user->avatar = $validated['avatar'];
        $user->email = $validated['email'];

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
            $user->save();
            $user->sendEmailVerificationNotification();
        } else {
            $user->save();
        }

        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function password(Request $request)
    {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'string'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (! Hash::check($validated['current_password'], $user->password)) {
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

        if (! Hash::check($validated['confirmSessionPassword'], $user->password)) {
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

        if (! Hash::check($validated['confirmDeletePassword'], $user->password)) {
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

    public function forgotPasswordIndex()
    {
        return view('auth.forgot-password');
    }

    public function forgotPasswordStore(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['email' => __($status)]);
    }

    public function resetPasswordIndex(Request $request, $token)
    {
        return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
    }

    public function resetPasswordStore(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => ['required', 'confirmed', PasswordRule::defaults()],
        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password),
                ])->setRememberToken(Str::random(60));

                $user->save();
            }
        );

        return $status === Password::PASSWORD_RESET
            ? redirect()->route('auth.index')->with('status', __($status))
            : back()->withErrors(['email' => [__($status)]]);
    }

    public function verifyEmailIndex(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
            ? redirect()->intended('/')
            : view('auth.verify-email');
    }

    public function verifyEmailStore(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->intended('/')->with('success', 'Email verified successfully');
    }

    public function verifyEmailResend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended('/');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
