<?php

namespace App\Http\Livewire\Admin\Search;

use App\Models\Orders\Search as OrdersSearch;
use App\Models\User;
use App\Models\Zones\Country;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class SearchHistory extends Component
{
    use WithPagination;

    public $users;
    public $user_id = '0';

    public $countries;
    public $from_country_id = '0';
    public $to_country_id = '0';

    public $shipping_type = '0';
    public $package_type = '0';

    public $start_date;
    public $end_date;

    public function mount()
    {
        $this->users = User::whereIs(['reseller', 'reselleruser'])->get();
        $this->countries = Country::select('id', 'name')->get();
    }

    public function render()
    {
        $query = OrdersSearch::latest();

        if ($this->user_id !== '0') {
            $query->where('user_id', $this->user_id);
        }
        if ($this->from_country_id !== '0') {
            $query->where('from_country', $this->from_country_id);
        }
        if ($this->to_country_id !== '0') {
            $query->where('to_country', $this->to_country_id);
        }
        if ($this->shipping_type !== '0') {
            $query->where('shipment_type', $this->shipping_type);
        }
        if ($this->package_type !== '0') {
            $query->where('package_type', $this->package_type);
        }


        if ($this->start_date && $this->end_date) {
            $st_date = Carbon::parse($this->start_date)->startOfDay();
            $en_date = Carbon::parse($this->end_date)->endOfDay();
            $query->whereBetween('created_at', [$st_date, $en_date]);
        }

        $searches = $query->with(['user', 'fromCountry', 'toCountry'])->paginate(15);

        return view('livewire.admin.search.search-history')->extends('layouts.admin')->with([
            'searches' => $searches
        ]);
    }

    public function paginationView()
    {
        return 'vendor.livewire.custom';
    }
}
