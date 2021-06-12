<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticationLoginRequest;
use App\Http\Requests\AuthenticationRegisterRequest;
use App\Models\User;
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

        if (!empty($request->remember_me) && $request->remember_me === '1') {
            $rememberMe = true;
        }

        if (!Auth::attempt($request->only(['email', 'password']), $rememberMe)) {
            return redirect()->back()->withErrors([
                'credential' => 'Wrong username and password combination.'
            ]);
        }

        if (Auth::user()->role === $this->getAdministratorKeyName()) {
            return redirect()->route('admin.home');
        }

        return redirect()->route('home');
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

        return redirect()->route('login');
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
