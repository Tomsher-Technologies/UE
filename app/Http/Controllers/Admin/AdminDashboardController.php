<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use App\Models\Orders\Search;
use App\Models\User;
use Bouncer;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $period = CarbonPeriod::create(Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek());

        $vendors = User::whereIs('reseller', 'reselleruser')->count();
        $searches = Search::count();
        $bookings = Order::count();

        $bookings_this_week = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->with(['user', 'integrator', 'search', 'search.toCountry', 'search.fromCountry'])->get();
        $recent_booking = $bookings_this_week->sortBy('created_at')->take(5);


        // Search chart
        $seaches_this_week = Search::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get();
        $search_data = collect();
        foreach ($period as $date) {
            $date_r = $date->format('Y-m-d');
            $start_date = $date->startOfDay()->format('Y-m-d H:i:s');
            $end_date = $date->endOfDay()->format('Y-m-d H:i:s');
            $count = $seaches_this_week->whereBetween('created_at', [$start_date, $end_date])->count();
            $search_data->put($date_r, $count);
        }

        $searchchartjs = app()->chartjs
            ->name('searchchartjs')
            ->size(['width' => 400, 'height' => 200])
            ->type('line')
            ->labels(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])
            ->datasets([
                [
                    "label" => "Total Booking This Week",
                    'backgroundColor' => "rgb(0, 107, 110,0.31)",
                    'borderColor' => "rgba(0, 107, 110, 0.7)",
                    "pointBorderColor" => "rgba(0, 107, 110, 0.7)",
                    "pointBackgroundColor" => "rgba(0, 107, 110, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $search_data->flatten()->toArray(),
                ]
            ]);

        // Booking chart
        $booking_data = collect();
        foreach ($period as $date) {
            $date_r = $date->format('Y-m-d');
            $start_date = $date->startOfDay()->format('Y-m-d H:i:s');
            $end_date = $date->endOfDay()->format('Y-m-d H:i:s');
            $count = $bookings_this_week->whereBetween('created_at', [$start_date, $end_date])->count();
            $booking_data->put($date_r, $count);
        }

        $bookingchartjs = app()->chartjs
            ->name('bookingchartjs')
            ->size(['width' => 400, 'height' => 200])
            ->type('line')
            ->labels(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'])
            ->datasets([
                [
                    "label" => "Total Booking This Week",
                    'backgroundColor' => "rgb(0, 107, 110,0.31)",
                    'borderColor' => "rgba(0, 107, 110, 0.7)",
                    "pointBorderColor" => "rgba(0, 107, 110, 0.7)",
                    "pointBackgroundColor" => "rgba(0, 107, 110, 0.7)",
                    "pointHoverBackgroundColor" => "#fff",
                    "pointHoverBorderColor" => "rgba(220,220,220,1)",
                    'data' => $booking_data->flatten()->toArray(),
                ]
            ]);


        return view('admin.pages.dashboard')->with([
            'searches' => $searches,
            'bookings' => $bookings,
            'customer' => $vendors,
            'recent_booking' => $recent_booking,
            'bookingchartjs' => $bookingchartjs,
            'bookings_this_week' => $bookings_this_week,
            'seaches_this_week' => $seaches_this_week->count(),
            'searchchartjs' => $searchchartjs,
        ]);
    }
}
