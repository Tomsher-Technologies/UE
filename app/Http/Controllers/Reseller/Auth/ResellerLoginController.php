<?php

namespace App\Http\Controllers\Reseller\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResellerLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(['guest']);
    }
    public function loginView()
    {
        return view('reseller.auth.login');
    }

    public function authenticate(Request $request)
    {

        $request->validate([
            'email' => "required|email",
            'password' => "required"
        ], [
            'email.required' => "Please enter your email.",
            'email.email' => "Please enter a valid email",
            'password.required' => "Please enter your password",
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];

        if (Auth::attempt($credentials, $request->remember_me)) {
            $request->session()->regenerate();
            if (Auth::user()->isAn('reseller')) {
                return redirect()->intended(route('reseller.dashboard'));
            } else {
                Session::flush();
                Auth::logout();
                return redirect()->route('home');
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
