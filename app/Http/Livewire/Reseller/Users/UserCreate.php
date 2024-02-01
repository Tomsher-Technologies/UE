<?php

namespace App\Http\Livewire\Reseller\Users;

use App\Helpers\Password;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $parent_user;

    public $parents;


    protected function rules()
    {
        return [
            'password' => ['required', new Password],
            'name' => 'required',
            'email' => ['required', 'email'],
            'parent_user' => 'required',
        ];
    }

    protected $messages = [
        'password.required' => 'Please enter a password',
        'parent_user.required' => 'Please select a assigned user',
        'name.required' => 'Please enter a name',
        'email.email' => 'The email address format is not valid.',
        'email.required' => 'The email address is required.',
    ];

    public function mount()
    {
        $this->parents = User::whereIs('reselleruser')->where('parent_id', Auth()->user()->id)->get();
        $this->parent_user = Auth()->user()->id;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $customer = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'status' => 1,
            'parent_id' => $this->parent_user,
            'grade_id' => 0,
        ]);

        Bouncer::assign('enduser')->to($customer);

        $this->reset('name');
        $this->reset('email');
        $this->reset('password');
        $this->reset('parent_user');

        Bouncer::refresh();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.reseller.users.user-create')->extends('layouts.reseller.app');
    }
}
