<?php

namespace App\Http\Livewire\Admin\UeUser;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = "";
    public $pageCount = 15;


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

    public function render()
    {
        $query = User::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        $users = $query->whereIs('ueuser')->paginate($this->pageCount);

        return view('livewire.admin.ue-user.index')->with([
            'users' => $users
        ]);
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
