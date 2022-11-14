<?php

namespace App\Http\Livewire\Reseller\Agent;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AgentIndex extends Component
{

    use WithPagination;

    public $search = "";
    public $pageCount = 15;

    public function render()
    {
        $query = User::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        $agents = $query->whereIs('reselleruser')->where('parent_id', Auth()->user()->id)->with('customerDetails')->paginate($this->pageCount);

        return view('livewire.reseller.agent.agent-index')->extends('layouts.reseller.app')->with([
            'agents' => $agents
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
