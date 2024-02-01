<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use App\Models\Zone\Pincode;
use App\Models\Zones\City;
use App\Models\Zones\Country;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function getCountries(Request $request)
    {
        return Country::where('name', 'LIKE', $request->name . "%")->orWhere('search_keyword', 'LIKE', "%" . $request->name . "%")->select(['id', 'name as text'])->get();
        // return $countries;
        // return json_encode(array('result' => $countries));
    }

    public function getCities(Request $request)
    {
        $country_code = Country::where('id', $request->country)->first()->code;

        if ($request->name && $request->name !== '' && $request->name !== NULL) {
            $cities = City::where('country_code', $country_code)->where('city', 'LIKE', $request->name . "%")->select(['id', 'city as text'])->get();
        } else {
            $cities = City::where('country_code', $country_code)->limit(10)->where('city', 'LIKE', $request->name . "%")->select(['id', 'city as text'])->get();
        }

        // if ($request->name && $request->name !== '' && $request->name !== NULL) {
        //     $cities = City::where('country_id', $request->country)->where('city', 'LIKE', $request->name . "%")->select(['id', 'city as text'])->get();
        // } else {
        //     $cities = City::where('country_id', $request->country)->limit(10)->where('city', 'LIKE', $request->name . "%")->select(['id', 'city as text'])->get();
        // }

        // if ($cities->count() == 0) {
        //     $cities->push(
        //         array(
        //             [
        //                 'id' => $request->name,
        //                 'text' => $request->name,
        //             ]
        //         )
        //     );
        // }

        return $cities;
    }

    public function getPincode(Request $request)
    {

        $country_code = Country::select('code')->where('id', $request->country)->first()->code;
        
        $city = City::where('country_code', $country_code)
            ->where('city', $request->city)
            ->first();

        if ($request->name && $request->name !== '' && $request->name !== NULL) {
            $pincode = Pincode::where('city_id', $city->id)
                ->where('pincode', 'LIKE', $request->name . "%")
                ->select(['id', 'pincode as text'])->get();
        } else {
            $pincode = Pincode::where('city_id', $city->id)
                ->limit(10)
                ->select(['id', 'pincode as text'])->get();
        }

        // $country_code = Country::select('code')->where('id', $request->country)->first()->code;

        // if ($request->name && $request->name !== '' && $request->name !== NULL) {
        //     $pincode = City::where('country_code',  $country_code)
        //         ->where('city', $request->city)
        //         // ->where('pincode', 'LIKE', $request->name . "%")
        //         ->select(['id', 'pincode as text'])->get();
        // } else {
        //     $pincode = City::where('country_code', $country_code)
        //         ->where('city', $request->city)
        //         // ->where('pincode', 'LIKE', $request->name . "%")
        //         ->limit(10)
        //         ->select(['id', 'pincode as text'])->get();
        // }
        return $pincode;
    }
}
