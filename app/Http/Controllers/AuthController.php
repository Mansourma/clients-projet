<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Handle the login process
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('home.home')->with('mixin', 'Connexion reussie');
        }

        return redirect()->back()->withInput($request->only('email'))->with('error', 'Email or password incorrect');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
