<?php

namespace App\Http\Livewire\Admin\UeUser;

use App\Helpers\Password;
use App\Models\User;
use Livewire\Component;
use Bouncer;
use Silber\Bouncer\Database\Ability;

class Create extends Component
{

    public $name;
    public $email;
    public $password;

    public $selectedPermission = [];
    public $permissions;

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', new Password],
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter a name',
        'email.required' => 'The email address cannot be empty.',
        'password.required' => 'Please enter a password',
        'email.email' => 'The email address format is not valid.',
    ];


    public function mount()
    {
        $this->permissions = Ability::get();
        foreach ($this->permissions as  $permissions) {
            $this->selectedPermission[$permissions->id] = 0;
        }
    }

    public function save()
    {
        $validatedData = $this->validate();

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'status' => 1,
            'password' => $this->password,
            'parent_id' => 1,
            'grade_id' => 0,
        ]);

        Bouncer::assign('ueuser')->to($user);

        foreach ($this->selectedPermission as $key => $selectedPermission) {
            if ($selectedPermission) {
                $user->allow($key);
            }
        }

        Bouncer::refresh();

        $this->reset('name');
        $this->reset('email');
        $this->reset('password');
        $this->reset('selectedPermission');
        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.ue-user.create');
    }
}
