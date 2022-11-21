<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use App\Models\Orders\Search;
use App\Models\User;
use Bouncer;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $vendors = User::whereIs(['reseller', 'reselleruser'])->count();
        $searches = Search::count();
        $bookings = Order::count();


        $recent_booking = Order::where('order_status', 1)->latest()->limit(5)->with(['user', 'integrator', 'search', 'search.toCountry', 'search.fromCountry'])->get();

        // dd($recent_booking);

        return view('admin.pages.dashboard')->with([
            'searches' => $searches,
            'bookings' => $bookings,
            'customer' => $vendors,
            'recent_booking' => $recent_booking,
        ]);
    }
}
