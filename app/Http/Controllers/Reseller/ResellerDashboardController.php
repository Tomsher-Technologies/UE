<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ResellerDashboardController extends Controller
{
    public function index()
    {

        $user = Auth()->user();

        $customer = $user->children;

        $total_customer = $customer->count();
        $total_customer_month = $customer->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $total_customer_week = $customer->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $total_customer_day = $customer->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();

        $search = $user->searches;
        $total_search = $search->count();
        $total_search_month = $search->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $total_search_week = $search->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $total_search_day = $search->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();

        $orders = $user->orders;
        $total_orders = $orders->count();
        $total_orders_month = $orders->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])->count();
        $total_orders_week = $orders->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count();
        $total_orders_day = $orders->whereBetween('created_at', [Carbon::now()->startOfDay(), Carbon::now()->endOfDay()])->count();


        $total_orders = $user->orders->count();

        return view('reseller.pages.dashboard')->with([
            'total_customer' => $total_customer,
            'total_customer_month' => $total_customer_month,
            'total_customer_week' => $total_customer_week,
            'total_customer_day' => $total_customer_day,

            'total_search' => $total_search,
            'total_search_month' => $total_search_month,
            'total_search_week' => $total_search_week,
            'total_search_day' => $total_search_day,


            'total_orders' => $total_orders,
            'total_orders_month' => $total_orders_month,
            'total_orders_week' => $total_orders_week,
            'total_orders_day' => $total_orders_day,
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        Session::flush();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('reseller.login');
    }
}
