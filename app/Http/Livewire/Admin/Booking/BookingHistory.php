<?php

namespace App\Http\Livewire\Admin\Booking;

use App\Exports\OrderExport;
use App\Models\Orders\Order;
use App\Models\User;
use App\Models\Zones\Country;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class BookingHistory extends Component
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

    public Order $selectedOrder;


    public function mount()
    {
        $this->users = User::whereIs(['reseller', 'reselleruser'])->get();
        $this->countries = Country::select('id', 'name')->get();
    }


    public function render()
    {
        $query = Order::latest();

        if ($this->user_id !== '0') {
            $query->where('user_id', $this->user_id);
        }

        if ($this->start_date && $this->end_date) {
            $st_date = Carbon::parse($this->start_date)->startOfDay();
            $en_date = Carbon::parse($this->end_date)->endOfDay();
            $query->whereBetween('created_at', [$st_date, $en_date]);
        }

        if ($this->from_country_id !== '0') {
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->from_country ==  $this->from_country_id;
            // });
            $from_country_id = $this->from_country_id;
            $query->whereHas('search', function ($query) use ($from_country_id) {
                $query->where('from_country', $from_country_id);
            });
        }

        if ($this->to_country_id !== '0') {
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->to_country ==  $this->to_country_id;
            // });
            $to_country_id = $this->to_country_id;
            $query->whereHas('search', function ($query) use ($to_country_id) {
                $query->where('to_country', $to_country_id);
            });
        }

        if ($this->shipping_type !== '0') {
            $shipping_type = $this->shipping_type;
            $query->whereHas('search', function ($query) use ($shipping_type) {
                $query->where('shipment_type', $shipping_type);
            });
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->shipment_type ==  $this->shipping_type;
            // });
            // $query->where('shipment_type', $this->shipping_type);
        }

        if ($this->package_type !== '0') {
            $package_type = $this->package_type;
            $query->whereHas('search', function ($query) use ($package_type) {
                $query->where('package_type', $package_type);
            });
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->package_type ==  $this->package_type;
            // });
            // $query->where('package_type', $this->package_type);
        }

        $bookings = $query->with(['user', 'search', 'search.fromCountry', 'search.toCountry'])->paginate(15);

        // $collection = $bookings->getCollection();


        // if ($this->to_country_id !== '0') {
        //     $collection = $collection->filter(function ($item) {
        //         return $item->search->to_country ==  $this->to_country_id;
        //     });
        //     // $query->where('to_country', $this->to_country_id);
        // }



        // $bookings->setCollection($collection);

        // dd($bookings);

        return view('livewire.admin.booking.booking-history')->extends('layouts.admin')->with([
            'bookings' => $bookings
        ]);
    }

    public function showModal(Order $booking)
    {
        $this->selectedOrder = $booking;
        $this->dispatchBrowserEvent('showModal');
    }

    public function paginationView()
    {
        return 'vendor.livewire.custom';
    }

    public function export()
    {
        $export = new OrderExport(
            $this->user_id,
            $this->start_date,
            $this->end_date,
            $this->from_country_id,
            $this->to_country_id,
            $this->shipping_type,
            $this->package_type,
        );
        return Excel::download($export, 'booking-history.xlsx');
    }
}
