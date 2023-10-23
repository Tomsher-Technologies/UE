<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders\Order;
use App\Models\Orders\Search;
use App\Models\User;
use App\Models\Zones\Country;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function userDetails(User $user)
    {
        $quotes = Search::whereUserId($user->id)->with(['items', 'toCountry', 'fromCountry'])->limit(10)->get();
        $bookings = Order::where('order_status', 1)
            ->whereUserId($user->id)
            ->with(['search', 'search.items', 'search.toCountry', 'search.fromCountry', 'integrator'])
            ->limit(10)
            ->get();

        $top_countries = [];

        $temp_import = [];
        $temp_export = [];
        $temp_trans_to = [];
        $temp_trans_from = [];

        foreach ($bookings as $booking) {
            $search = $booking->search;
            if ($search->shipment_type == 'import') {
                if (isset($temp_import[$search->fromCountry->name])) {
                    $temp_import[$search->fromCountry->name]++;
                } else {
                    $temp_import[$search->fromCountry->name] = 1;
                }
            } elseif ($search->shipment_type == 'export') {
                if (isset($temp_export[$search->toCountry->name])) {
                    $temp_export[$search->toCountry->name]++;
                } else {
                    $temp_export[$search->toCountry->name] = 1;
                }
            }
        }


        arsort($temp_import);
        $top_countries['import'] = key($temp_import);

        arsort($temp_export);
        $top_countries['export'] = key($temp_export);

        return view('admin.reports.userdetails', compact('quotes', 'bookings', 'top_countries'));
    }
}
