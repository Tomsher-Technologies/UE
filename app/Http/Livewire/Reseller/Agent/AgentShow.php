<?php

namespace App\Http\Livewire\Reseller\Agent;

use App\Models\Customer\CustomerDetails;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class AgentShow extends Component
{

    use WithPagination;

    private $customers;
    public $selectedUsers = [];
    public $search;
    public $checkall = false;
    public User $user;
    public CustomerDetails $customerDetails;
    public $c_image;

    public function mount($user)
    {
        $this->user = $user;
        $this->customerDetails = $user->customerDetails;
        $this->c_image = $this->customerDetails->getProfileImage();

        $children = $this->user->children()->pluck('id');

        foreach ($children as $child) {
            $this->selectedUsers[] = $child;
        }
    }

    public function updatedCheckall($val)
    {
        if ($val) {
            $this->selectedUsers = [];
            foreach ($this->getCustomers() as $child) {
                $this->selectedUsers[] = (string)$child->id;
            }
        } else {
            $this->selectedUsers = [];
        }
    }

    public function assignUsers()
    {
        $this->user->children()->update([
            'parent_id' => Auth()->user()->id
        ]);

        User::whereIn('id', $this->selectedUsers)->update([
            'parent_id' => $this->user->id
        ]);

        $this->dispatchBrowserEvent('assigned');
    }

    public function getCustomers()
    {
        $query = User::whereStatus(true);

        $patent_ids = [];

        if (Auth()->user()->isA('reseller')) {
            $patent_ids = Auth()->user()->children->pluck('id')->toArray();
        }

        $patent_ids[] =  Auth()->user()->id;

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        return  $query->whereIs('enduser')->whereIn('parent_id', $patent_ids)->select(['id', 'name', 'email', 'parent_id'])->with('parent:id,name')->paginate(15);
    }

    public function render()
    {
        $customers = $this->getCustomers();

        return view('livewire.reseller.agent.agent-show')->extends('layouts.reseller.app')->with([
            'customers' => $customers
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
