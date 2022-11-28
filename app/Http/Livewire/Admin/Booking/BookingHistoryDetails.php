<?php

namespace App\Http\Livewire\Admin\Booking;

use App\Models\Orders\Order;
use Livewire\Component;

class BookingHistoryDetails extends Component
{

    public $order;

    public function mount(Order $order){
        $this->order = $order;
        $this->order->load(['search','search.toCountry','search.fromCountry']);
    }

    public function render()
    {
        return view('livewire.admin.booking.booking-history-details')->extends('layouts.admin');
    }
}
