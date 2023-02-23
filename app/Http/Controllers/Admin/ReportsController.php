<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Orders\Search;
use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(Request $request)
    {
        // $search_query = Search::with([
        //     'user',
        //     'toCountry',
        //     'fromCountry',
        // ]);

        // if ($request->search_start_date) {
        //     $end_date = $request->search_start_date ?? $request->search_start_date;
        //     $search_query->whereBetween('create_at',[
        //         $request->search_start_date
        //     ])
        // }

        // $searches = $search_query->get();

        // dd($searches);

        return view('admin.reports.index');
    }
}
