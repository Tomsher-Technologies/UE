<?php

namespace App\Http\Livewire\Reseller;

use App\Models\Zones\Country;
use Livewire\Component;

class SearchInputs extends Component
{

    public $countries;
    public $fromcountries;
    public $tocountries;

    public $selectedFromCountry;
    public $fromcountry;


    public function mount()
    {
        $this->countries = Country::select(['id', 'name as text'])->get();
    }

    public function render()
    {
        if ($this->fromcountry) {
            $this->fromcountries = $this->countries->where('name', $this->fromcountry);
        } else {
            $this->fromcountries = $this->countries->take(10);
        }

        return view('livewire.reseller.search-inputs');
    }

    public function updatedFromcountry($id)
    {
        $this->fromcountry = $id;
    }









    protected function getListeners()
    {
        return ['updatedFromcountry' => 'updatedFromcountry'];
    }
}
