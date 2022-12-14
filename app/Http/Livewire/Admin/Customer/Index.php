<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer\Grade;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = "";
    public $pageCount = 15;

    public $grades;
    public $selectedGrade = "0";

    public function mount()
    {
        $this->grades = Grade::all();
    }

    public function render()
    {
        $query = User::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->selectedGrade !== "0") {
            $query->where('grade_id', $this->selectedGrade);
        }

        $users = $query->whereIs('reseller')->with('customerDetails')->paginate($this->pageCount);

        return view('livewire.admin.customer.index')->with([
            'users' => $users
        ]);
    }

    public function toggleStatus($id)
    {
        $user = User::where('id', $id)->first();
        $user->update([
            'status' => !$user->status
        ]);
        $this->dispatchBrowserEvent('statusChange', ['status' => $user->status]);
    }

    public function deleteUser($id)
    {
        $status = User::where('id', $id)->first()->delete();
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

    public function updatedselectedGrade()
    {
        // dd($this->selectedGrade);
        $this->resetPage();
    }
}
