<?php

namespace App\Http\Livewire\Admin\UeUser;

use App\Helpers\Password;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Bouncer;

class Edit extends Component
{

    use WithPagination;

    public User $user;

    public $password;

    public $search;

    public $selectedUsers = [];


    protected function rules()
    {
        return [
            'user.status' => 'required',
            'user.name' => 'required',
            'user.email' => ['required', 'email', 'unique:users,email,' . $this->user->id],
            'password' => ['nullable', new Password],
        ];
    }

    protected $messages = [
        'user.name.required' => 'Please enter a name',
        'user.email.required' => 'The email address cannot be empty.',
        'user.email.email' => 'The email address format is not valid.',
    ];


    public function save()
    {
        $validatedData = $this->validate();

        $this->user->save();

        if ($this->password) {
            $this->user->update([
                'password' => $this->password
            ]);
            $this->reset('password');
        }

        Bouncer::refresh();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($user)
    {
        $this->user = $user;
    }

    public function render()
    {
        $query = User::whereStatus(true);

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        $customers = $query->whereIs('reseller')->select(['id', 'name', 'email', 'parent_id'])->with('parent:id,name')->paginate(15);
        
        return view('livewire.admin.ue-user.edit')->with([
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
