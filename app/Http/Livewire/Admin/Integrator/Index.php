<?php

namespace App\Http\Livewire\Admin\Integrator;

use App\Models\Integrators\Integrator;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = "";
    public $pageCount = 15;

    public function render()
    {

        $query = Integrator::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%')
                ->orWhere('phone', 'LIKE', '%' . $this->search . '%')
                ->orWhere('address', 'LIKE', '%' . $this->search . '%');
        }

        $integrators = $query->paginate($this->pageCount);

        return view('livewire.admin.integrator.index')->with([
            'integrators' => $integrators
        ]);
    }

    public function deleteUser($id)
    {
        $status = Integrator::where('id', $id)->first()->delete();
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
