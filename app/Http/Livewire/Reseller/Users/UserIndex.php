<?php

namespace App\Http\Livewire\Reseller\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class UserIndex extends Component
{

    use WithPagination;

    public $search = "";
    public $pageCount = 15;


    public function render()
    {
        $patent_ids = [];

        if (Auth()->user()->isA('reseller')) {
            $patent_ids = Auth()->user()->children->pluck('id')->toArray();
        }

        $patent_ids[] =  Auth()->user()->id;

        $query = User::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        $users = $query->whereIs('enduser')->whereIn('parent_id', $patent_ids)->with('customerDetails')->paginate($this->pageCount);

        return view('livewire.reseller.users.user-index')->extends('layouts.reseller.app')->with([
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
}
