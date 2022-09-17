<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Bouncer;

class LoginController extends Controller
{

    public function __construct()
    {
        $this->middleware(['guest']);
    }

    public function loginView()
    {
        return view('admin.auth.login');
    }

    public function authenticate(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'status' => 1
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            if (Auth::user()->isAn('admin')) {
                return redirect()->intended(route('admin.dashboard'));
            } else if (Auth::user()->isAn('ueuser')) {
                return redirect()->intended(route('ueuser.dashboard'));
            } else {
                return redirect()->route('logout');
            }
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function registerView()
    {
        return view('admin.auth.login');
    }

    public function register()
    {
        return view('admin.auth.login');
    }
}
