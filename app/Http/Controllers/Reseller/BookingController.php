<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookingView(Request $request)
    {
        return view('reseller.pages.booking')->with([
            'request' => $request
        ]);
    }

    public function booking(Request $request)
    {
    }
}
