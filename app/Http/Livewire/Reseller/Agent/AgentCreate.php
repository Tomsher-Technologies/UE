<?php

namespace App\Http\Livewire\Reseller\Agent;

use App\Helpers\Password;
use App\Models\User;
use Livewire\Component;
use Bouncer;

class AgentCreate extends Component
{

    public $name;
    public $email;
    public $password;
    public $phone;
    public $address;
    public $msp;
    public $msp_type = 'percentage';
    public $profit_margin;
    public $profit_margin_type = 'percentage';
    public $limit_weight;
    public $request_limit;

    public $image;

    protected function rules()
    {
        return [
            'password' => ['required', new Password],
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'msp' => ['nullable', 'integer'],
            'msp_type' => ['nullable'],
            'msp_type' => ['nullable'],
            'request_limit' => ['nullable'],
            'limit_weight' => ['nullable'],
        ];
    }

    protected $messages = [
        'password.required' => 'Please enter a password',
        'parent_user.required' => 'Please select a assigned UE user',
        'name.required' => 'Please enter a name',
        'email.email' => 'The email address format is not valid.',
        'email.required' => 'The email address is required.',
    ];

    public function updatedPhoto()
    {
        $this->validate([
            'image' => 'file|mimes:png,jpg,jpeg,gif,webp|max:1024', // 1MB Max
        ], [
            'image.file' => "Please select valid image",
            'image.mimes' => "Please select valid .jpg, .jpeg, .png, .gif, .webp image",
            'image.uploaded' => "Image size can't be bigger than 1MB",
            'image.max' => "Image size can't be bigger than 1MB",
        ]);
    }

    public function save()
    {
        $validatedData = $this->validate();

        $customer = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'status' => 1,
            'parent_id' => Auth()->user()->id,
            'grade_id' => 0,
        ]);

        Bouncer::assign('reselleruser')->to($customer);

        $storedImage = NULL;
        if ($this->image) {
            $storedImage =  $this->image->store('public/agentphotos');
        }

        $customer->customerDetails()->create([
            'phone' => $this->phone,
            'address' => $this->address,
            'msp' => $this->msp !== "" ? $this->msp : NULL,
            'msp_type' => $this->msp_type,
            'image' => $storedImage,
            'request_limit' => $this->request_limit,
            'limit_weight' => $this->limit_weight,
        ]);

        $this->reset('name');
        $this->reset('email');
        $this->reset('phone');
        $this->reset('password');
        $this->reset('address');
        $this->reset('msp');
        $this->reset('msp_type');
        $this->reset('image');
        $this->reset('request_limit');
        $this->reset('limit_weight');
        $this->reset('profit_margin');

        Bouncer::refresh();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.reseller.agent.agent-create')->extends('layouts.reseller.app');
    }
}
