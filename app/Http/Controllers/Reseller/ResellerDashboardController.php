<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ResellerDashboardController extends Controller
{
    public function index()
    {
        return view('reseller.pages.dashboard-lv');
    }
}
