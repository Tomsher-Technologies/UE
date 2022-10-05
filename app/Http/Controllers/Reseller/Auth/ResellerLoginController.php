<?php

namespace App\Http\Controllers\Reseller\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rules\Password;
use Bouncer;

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

    public function registerView()
    {
        return view('reseller.auth.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => "required",
            'phone' => "required",
            'email' => "required|email|unique:users",
            'password' => ['required', 'confirmed'],
            'address' => ['required']
        ], [
            'address.required' => "Please enter your address.",
            'email.required' => "Please enter your email.",
            'email.email' => "Please enter a valid email",
            'password.required' => "Please enter your password",
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'status' => 3,
            'parent_id' => 0
        ]);

        Bouncer::assign('reseller')->to($user);

        $user->customerDetails()->create([
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return back()->with([
            'status' => "Your account has been created and sent for approval, once the admin approves your account, you will be able to login."
        ]);
    }
}
