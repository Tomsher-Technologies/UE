<?php

namespace App\Http\Livewire\Admin\SpecialRates;

use App\Models\SpecialRate;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $search = "";


    public function render()
    {
        $query = SpecialRate::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        }

        $specialrate = $query->with('user')->paginate(15);

        return view('livewire.admin.special-rates.listing')->with([
            'specialrate' => $specialrate,
        ]);
    }

    public function approveRate($id)
    {
        $rate = SpecialRate::where('id', $id)->get()->first();
        $rate->update([
            'status' => 1,
            'approval_date' => Carbon::now(),
            'approved_rate' => $rate->approved_rate ?? $rate->request_rate
        ]);
        $this->dispatchBrowserEvent('rateApproved');
    }

    public function deleteUser($id)
    {
        $status = SpecialRate::where('id', $id)->first()->update([
            'status' => 2,
        ]);
        $this->dispatchBrowserEvent('modelDeleted');
    }

    public function paginationView()
    {
        return 'vendor.livewire.custom';
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
