<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Helpers\Password;
use App\Models\Customer\CustomerDetails;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Bouncer;

class Edit extends Component
{

    use WithFileUploads;

    public User $user;
    public CustomerDetails $customerDetails;

    public $image;
    public $c_image;
    public $password;

    protected function rules()
    {
        return [
            'password' =>  ['nullable', new Password],
            'user.name' => 'required',
            'user.email' => ['nullable', 'email'],
            'customerDetails.phone' => ['nullable'],
            'customerDetails.address' => ['nullable'],
            'customerDetails.msp' => ['nullable', 'integer'],
            'customerDetails.msp_type' => ['nullable'],
            'customerDetails.profit_margin' => ['nullable', 'integer'],
            'customerDetails.profit_margin_type' => ['nullable'],
        ];
    }

    protected $messages = [
        'user.name.required' => 'Please enter a name',
        'user.email.email' => 'The email address format is not valid.',
        'user.email.required' => 'The email address is required.',
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
            $this->user->password = $this->password;
        }

        $this->user->save();

        if ($this->image) {
            $storedImage =  $this->image->store('public/customerphotos');

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

    public function mount($user)
    {
        $this->user = $user;
        $this->customerDetails = $user->customerDetails;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->c_image = $this->customerDetails->getProfileImage();
        return view('livewire.admin.customer.edit');
    }
}
