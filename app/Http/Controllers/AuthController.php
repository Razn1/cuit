<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request) : RedirectResponse
    {
        User::create([
            'name' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);
        return redirect('/login');
    }

    public function showLogin()
    {
        return view('login');
    }
    public function login(Request $request) : RedirectResponse
    {
        if (Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
        ]))
        {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            return redirect('/');
        }
        return redirect('/login')->with('error', 'Email or password is incorrect');
    }

    public function logout(Request $request) : RedirectResponse
    {
        Auth::logout();
        return redirect('/log')->with('success', 'Logout successfully');
    }
}
