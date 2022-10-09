<?php

namespace App\Http\Livewire\Admin\SpecialRates;

use App\Models\SpecialRate;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{
    use WithPagination;

    public $search = "";

    public User $user;

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $query = $this->user->specialrate()->latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        }

        $specialrate = $query->paginate(15);

        return view('livewire.admin.special-rates.listing')->with([
            'user' => $this->user,
            'specialrate' => $specialrate,
        ]);
    }

    public function deleteUser($id)
    {
        $status = SpecialRate::where('id', $id)->first()->delete();
        if ($status) {
            $this->dispatchBrowserEvent('modelDeleted');
        } else {
            $this->dispatchBrowserEvent('modelDeletedFailed');
        }
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
