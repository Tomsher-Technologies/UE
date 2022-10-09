<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Zones\City;
use App\Models\Zones\Country;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getCountries(Request $request)
    {
        $countrie = Country::where('name', 'LIKE', $request->name . "%")->select(['id', 'name'])->get();
        return $countrie;
    }

    // public function getCities(Request $request)
    // {
    //     $cities = City::where('city', 'LIKE', $request->name)->select(['id', 'city as name'])->get();
    //     return $cities;
    // }
}
