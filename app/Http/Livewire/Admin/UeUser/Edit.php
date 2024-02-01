<?php

namespace App\Http\Livewire\Admin\UeUser;

use App\Helpers\Password;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Bouncer;
use Illuminate\Support\Facades\Hash;
use Silber\Bouncer\Database\Ability;

class Edit extends Component
{

    use WithPagination;

    public User $user;

    public $password;

    public $search;

    public $checkall = false;

    public $selectedUsers = [];

    public $selectedPermission = [];
    public $permissions;
    public $userAbilities;

    private $customers;

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

    public function save()
    {
        $validatedData = $this->validate();
        $this->user->save();
        if ($this->password) {
            $this->user->update([
                'password' => Hash::make($this->password)
            ]);
            $this->reset('password');
        }
        Bouncer::refreshFor($this->user);
        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function savePermission()
    {
        Bouncer::sync($this->user)->abilities([]);

        foreach ($this->selectedPermission as $key => $selectedPermission) {
            if ($selectedPermission) {
                $abi = $this->permissions->where('id', $key)->first();
                $this->user->allow($abi);
            }
        }
        Bouncer::refreshFor($this->user);
        $this->dispatchBrowserEvent('permissionUpdated');
    }

    public function assignUsers()
    {
        $this->user->children()->update([
            'parent_id' => 0
        ]);

        User::whereIn('id', $this->selectedUsers)->update([
            'parent_id' => $this->user->id
        ]);

        $this->dispatchBrowserEvent('assigned');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount($user)
    {
        $this->user = $user;
        $this->permissions = Ability::all();

        $this->userAbilities = $this->user->getAbilities();
        $userAbilities = $this->userAbilities->pluck('id')->toArray();

        foreach ($this->permissions as  $permissions) {
            if (in_array($permissions->id, $userAbilities)) {
                $this->selectedPermission[$permissions->id] = 1;
            } else {
                $this->selectedPermission[$permissions->id] = 0;
            }
        }

        $children = $this->user->children()->pluck('id');
        foreach ($children as $child) {
            $this->selectedUsers[] = $child;
        }
    }


    public function getCustomers()
    {
        $query = User::whereStatus(true);

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        return  $query->whereIs('reseller')->select(['id', 'name', 'email', 'parent_id'])->with('parent:id,name')->paginate(15);
    }

    public function render()
    {
        $customers = $this->getCustomers();

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
