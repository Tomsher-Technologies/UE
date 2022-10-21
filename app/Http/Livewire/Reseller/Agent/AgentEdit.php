<?php

namespace App\Http\Livewire\Reseller\Agent;

use App\Helpers\Password;
use App\Models\Customer\CustomerDetails;
use App\Models\User;
use Bouncer;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AgentEdit extends Component
{
    use WithFileUploads;
    
    public User $agent;
    public CustomerDetails $customerDetails;

    public $image;
    public $c_image;
    public $password;

    protected function rules()
    {
        return [
            'agent.password' =>  ['nullable', new Password],
            'agent.name' => 'required',
            'agent.email' => ['required', 'email', 'unique:users,email,' . $this->agent->id],
            'agent.grade_id' => ['required'],
            'customerDetails.phone' => ['nullable'],
            'customerDetails.address' => ['nullable'],
            'customerDetails.msp' => ['nullable', 'integer'],
            'customerDetails.msp_type' => ['nullable'],
            'customerDetails.request_limit' => ['nullable'],
            'customerDetails.limit_weight' => ['nullable'],
            'customerDetails.profit_margin' => ['nullable'],
            'customerDetails.profit_margin_type' => ['nullable'],
        ];
    }

    protected $messages = [
        'agent.name.required' => 'Please enter a name',
        'agent.email.email' => 'The email address format is not valid.',
        'agent.email.required' => 'The email address is required.',
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

        if ($this->password !== '') {
            $this->agent->password = $this->password;
        }

        $this->agent->save();

        if ($this->image) {
            $storedImage =  $this->image->store('public/agentphotos');

            if (Storage::exists($this->customerDetails->image)) {
                Storage::delete($this->customerDetails->image);
            }

            $this->customerDetails->image =  $storedImage;
            $this->reset('image');
        }

        $this->customerDetails->save();

        $this->reset('password');

        Bouncer::refresh();


        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function mount(User $user)
    {
        $this->agent = $user;
        $this->customerDetails = $user->customerDetails;
    }

    public function render()
    {
        $this->c_image = $this->customerDetails->getProfileImage();
        return view('livewire.reseller.agent.agent-edit')->extends('layouts.reseller.app');
    }
}
