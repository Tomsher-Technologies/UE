<?php

namespace App\Http\Livewire\Admin\Surcharge;

use App\Models\Surcharge\Surcharge;
use Livewire\Component;
use Livewire\WithPagination;

class Listing extends Component
{

    use WithPagination;

    public $search = "";

    public function render()
    {
        $query = Surcharge::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        }

        $surcharges = $query->paginate(15);

        return view('livewire.admin.surcharge.listing')->with([
            'surcharges' => $surcharges
        ]);
    }

    public function toggleStatus($id)
    {
        $user = Surcharge::where('id', $id)->first();
        $user->update([
            'status' => !$user->status
        ]);
        $this->dispatchBrowserEvent('statusChange', ['status' => $user->status]);
    }

    public function deleteUser($id)
    {
        $status = Surcharge::where('id', $id)->first()->delete();
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
