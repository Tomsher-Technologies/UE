<?php

namespace App\Http\Livewire\UeUser;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{

    use WithPagination;

    public $search = "";
    public $pageCount = 15;


    public function render()
    {
        $query = User::whereIs('ueuser')->latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        $users = $query->paginate($this->pageCount);

        return view('livewire.ue-user.index')->with([
            'users' => $users
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
