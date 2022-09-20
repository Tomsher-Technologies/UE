<?php

namespace App\Http\Livewire\UeUser;

use App\Helpers\Password;
use App\Models\User;
use Livewire\Component;

class Edit extends Component
{

    public User $user;

    public $password;

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
        return view('livewire.ue-user.edit');
    }
}
