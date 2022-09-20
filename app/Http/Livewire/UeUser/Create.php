<?php

namespace App\Http\Livewire\UeUser;

use App\Helpers\Password;
use App\Models\User;
use Livewire\Component;
use Bouncer;

class Create extends Component
{

    public $name;
    public $email;
    public $password;

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

    public function save()
    {
        $validatedData = $this->validate();
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'status' => 1,
            'password' => $this->password,
        ]);

        Bouncer::assign('ueuser')->to($user);

        $this->reset('name');
        $this->reset('email');
        $this->reset('password');
        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.ue-user.create');
    }
}
