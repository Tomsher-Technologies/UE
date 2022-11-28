<?php

namespace App\Http\Livewire\Reseller\Agent;

use App\Helpers\Password;
use App\Models\Customer\Grade;
use App\Models\User;
use Livewire\Component;
use Bouncer;
use Illuminate\Support\Str;

class AgentCreate extends Component
{

    public $name;
    public $email;
    public $password;
    public $grade;
    public $status;
    public $phone;
    public $address;
    public $msp;
    public $msp_type = 'percentage';
    public $profit_margin;
    public $profit_margin_type = 'percentage';
    public $limit_weight;
    public $request_limit;

    public $image;
    public $grades;

    protected function rules()
    {
        return [
            'password' => ['required', new Password],
            'name' => 'required',
            'grade' => 'required',
            'status' => 'required',
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

    public function mount()
    {
        $this->grades = Grade::all();
        $this->grade = $this->grades->first()->id;
        $this->status = 1;
    }

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
            'status' => $this->status,
            'parent_id' => Auth()->user()->id,
            'grade_id' => $this->grade,
            'verified' => 1,
        ]);

        Bouncer::assign('reselleruser')->to($customer);

        $storedImage = NULL;
        if ($this->image) {
            $storedImage =  $this->image->store('public/customerphotos');
        }

        $customer->customerDetails()->create([
            'phone' => $this->phone,
            'address' => $this->address,
            'msp' => $this->msp !== "" ? $this->msp : NULL,
            'msp_type' => $this->msp_type,
            'image' => Str::remove('public/', $storedImage),
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
