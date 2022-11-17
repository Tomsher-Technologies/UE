<?php

namespace App\Http\Livewire\Reseller;

use App\Models\Zones\Country;
use Livewire\Component;

class SearchInputs extends Component
{

    public $countries;

    public $selectedFromCountry;
    public $fromcountry;


    public function mount()
    {
        $this->countries = Country::select(['id', 'name as text'])->get();
    }

    public function render()
    {
        return view('livewire.reseller.search-inputs');
    }

    public function updatedFromcountry($val)
    {
        dd($val);
    }
}
