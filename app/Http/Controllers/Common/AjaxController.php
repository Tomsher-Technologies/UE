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
        $countries = Country::where('name', 'LIKE', $request->name . "%")->select(['id', 'name as text'])->get();
        return $countries;
        // return json_encode(array('result' => $countries));
    }

    public function getCities(Request $request)
    {
        $cities = City::where('fromCity', $request->country)->where('city', 'LIKE', $request->name)->select(['id', 'city as name'])->get();
        return $cities;
    }
}
