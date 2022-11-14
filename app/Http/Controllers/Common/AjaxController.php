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
        if ($request->name && $request->name !== '' && $request->name !== NULL) {
            $cities = City::where('country_id', $request->country)->where('city', 'LIKE', $request->name . "%")->select(['id', 'city as text'])->get();
        } else {
            $cities = City::where('country_id', $request->country)->limit(10)->where('city', 'LIKE', $request->name . "%")->select(['id', 'city as text'])->get();
        }
        return $cities;
    }

    public function getPincode(Request $request)
    {
        if ($request->name && $request->name !== '' && $request->name !== NULL) {
            $pincode = City::where('country_id', $request->country)
                ->where('city', 'LIKE', $request->city)
                ->where('pincode', 'LIKE', $request->name . "%")
                ->select(['id', 'city as text'])->get();
        } else {
            $pincode = City::where('country_id', $request->country)
                ->where('city', 'LIKE', $request->city)
                ->where('pincode', 'LIKE', $request->name . "%")
                ->limit(10)
                ->select(['id', 'pincode as text'])->get();
        }
        return $pincode;
    }
}
