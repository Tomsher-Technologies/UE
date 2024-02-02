<?php

namespace App\Http\Livewire\Admin\Settings;

use App\Models\Zone\Pincode;
use App\Models\Zones\City;
use App\Models\Zones\Country;
use Livewire\Component;

class CityPincodeController extends Component
{
    public $p_country = '';
    public $p_city = '';
    public $p_msg = null;
    public $p_success = null;


    public $n_country = '';
    public $n_city = '';
    public $n_pin = '';
    public $n_msg = null;
    public $n_success = null;



    public function render()
    {
        return view('livewire.admin.settings.city-pincode-controller')->extends('layouts.admin');
    }

    public function saveCity()
    {

        $this->reset('p_msg');
        $this->reset('p_success');
        $validatedData = $this->validate([
            'p_country' => 'required',
            'p_city' => 'required',
        ], [
            'p_country.required' => 'Please select a country',
            'p_city.required' => 'Please enter a city name',
        ]);


        $country = Country::find($this->p_country);

        $city = City::where('country_code', $country->code)->where('city', $this->p_city)->count();

        if ($city > 0) {
            $this->p_msg = "This city already exists for this country";
        } else {
            City::create([
                'country_code' => $country->code,
                'city' =>  $this->p_city
            ]);
            $this->p_success = "City created.";
        }
    }



    public function savePin()
    {

        $this->reset('n_msg');
        $this->reset('n_success');

        $validatedData = $this->validate([
            'n_country' => 'required',
            'n_city' => 'required',
            'n_pin' => 'required',
        ], [
            'n_country.required' => 'Please select a country',
            'n_city.required' => 'Please select a city',
            'n_pin.required' => 'Please enter a pincode',
        ]);


        $country = Country::find($this->n_country);
        $city = City::where('country_code', $country->code)->where('city', $this->n_city)->first();

        if ($city->count() == 0) {
            $this->n_msg = "This city does not exist";
        } else {
            $pin = Pincode::where('city_id', $city->id)
                ->where('pincode', $this->n_pin)->count();

            if ($pin > 0) {
                $this->n_msg = "This pin code already exist for this city";
            } else {
                Pincode::create([
                    'city_id' => $city->id,
                    'pincode' => $this->n_pin
                ]);
                $this->n_success = "Pincode created.";
            }
        }
    }
}
