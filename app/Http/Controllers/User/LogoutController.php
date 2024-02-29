<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LogoutController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function logout(Request $request)
    {
        // $route  = redirect()->route('home');
        // if (Auth::user()->isAn('admin') ||  Auth::user()->isAn('ueuser')) {
        //     $route = redirect()->route('admin.login');
        // } else if (Auth::user()->isA('reseller') ||  Auth::user()->isA('reselleruser')) {
        //     $route = redirect()->route('reseller.login');
        // }
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin.login');
    }
}
