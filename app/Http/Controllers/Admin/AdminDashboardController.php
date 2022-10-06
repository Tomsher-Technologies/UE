<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Bouncer;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $ueusers = User::whereIs('ueuser')->count();
        $vendors = User::whereIs(['reseller', 'reselleruser'])->count();
        $customer = 0;
        return view('admin.pages.dashboard')->with([
            'ueusers' => $ueusers,
            'vendors' => $vendors,
            'customer' => $customer,
        ]);
    }
}
