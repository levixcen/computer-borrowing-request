<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Requests\AuthenticationRegisterRequest;
use App\Models\User;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    /**
     * Display login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Checks credential given registered and verified in database.
     *
     * @param \App\Http\Requests\AuthenticationLoginRequest $request
     * @return \Illuminate\Http\Response
     */
    public function login(AuthenticationLoginRequest $request)
    {
        $rememberMe = false;

        if (!empty($request->remember_me) && $request->remember_me === 'on') {
            $rememberMe = true;
        }

        if (!Auth::attempt($request->only(['email', 'password']), $rememberMe)) {
            return redirect()->back()->withErrors([
                'credential' => 'Wrong username and password combination.'
            ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->role === $this->getAdministratorKeyName()) {
            return redirect()->intended(route('admin.home'));
        }

        return redirect()->intended(route('home'));
    }

    /**
     * Display register form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Registers new user account to database.
     *
     * @param \App\Http\Requests\AuthenticationRegisterRequest $request
     * @return \Illuminate\Http\Response
     */
    public function register(AuthenticationRegisterRequest $request)
    {
        $user = new User;
        $user->fill($request->only(['name', 'email']));
        $user->password = Hash::make($request->password);
        $user->save();

        $user->sendEmailVerificationNotification();

        return redirect()->route('auth.verification.notice');
    }

    /**
     * Display prompt for verify email.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVerifyPrompt()
    {
        return view('auth.email.verify');
    }

    /**
     * Display prompt for email verified.
     *
     * @return \Illuminate\Http\Response
     */
    public function showVerifiedPrompt()
    {
        return view('auth.email.verified');
    }

    /**
     * Verify email by check id and hash sent.
     *
     * @param \Illuminate\Foundation\Auth\EmailVerificationRequest $request
     * @return \Illuminate\Http\Response
     */
    public function verifyEmail(EmailVerificationRequest $request)
    {
        $request->fulfill();

        return redirect()->route('auth.email.verified');
    }

    /**
     * Resend verification email.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    }

    /**
     * Logged current user out from session and clears saved authentication data.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.form.login');
    }

    /**
     * Get Administrator role representation in database.
     *
     * @return string
     */
    private function getAdministratorKeyName()
    {
        return 'Administrator';
    }
}
