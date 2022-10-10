<?php

namespace App\Http\Controllers\UeUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UeUserDashboard extends Controller
{
    public function index()
    {
        return view('admin.pages.dashboard');
    }
}
