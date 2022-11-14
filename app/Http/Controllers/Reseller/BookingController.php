<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function bookingView(Request $request)
    {
        $details = Auth()->user()->customerDetails;
        return view('reseller.pages.booking')->with([
            'request' => $request,
            'details' => $details,
        ]);
    }

    public function booking(Request $request)
    {
        dd($request);
    }
}
