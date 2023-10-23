<?php

namespace App\Http\Livewire\Reseller\Users;

use App\Helpers\Password;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserEdit extends Component
{
    public User $user;
    public $password;

    protected function rules()
    {
        return [
            'password' => ['nullable', new Password],
            'user.name' => 'required',
            'user.email' => ['required', 'email'],
            'user.parent_id' => 'required',
        ];
    }

    protected $messages = [
        'user.parent_id.required' => 'Please select a assigned user',
        'user.name.required' => 'Please enter a name',
        'user.email.email' => 'The email address format is not valid.',
        'user.email.required' => 'The email address is required.',
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->parents = User::whereIs('reselleruser')->where('parent_id', Auth()->user()->id)->get();
        $this->parent_user = Auth()->user()->id;
    }

    public function save()
    {
        $validatedData = $this->validate();

        if ($this->password !== '') {
            $this->user->password = Hash::make($this->password);
        }

        $this->user->save();

        $this->reset('password');

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function render()
    {
        return view('livewire.reseller.users.user-edit')->extends('layouts.reseller.app');
    }
}
