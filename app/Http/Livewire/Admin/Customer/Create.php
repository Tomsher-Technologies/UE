<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Bouncer;

class Create extends Component
{
    use WithFileUploads;


    public $name;
    public $email;
    public $phone;
    public $password;
    public $address;
    public $msp;
    public $msp_type = 'percentage';
    public $profit_margin;
    public $profit_margin_type = 'percentage';

    public $parent_users;
    public $parent_user = 0;

    public $image;

    protected function rules()
    {
        return [
            'password' => 'required',
            'parent_user' => 'nullable',
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'msp' => ['nullable', 'integer'],
            'msp_type' => ['nullable'],
            'profit_margin' => ['nullable', 'integer'],
            'profit_margin_type' => ['nullable'],
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
            'parent_id' => $this->parent_user
        ]);

        Bouncer::assign('reseller')->to($customer);

        $storedImage = NULL;
        if ($this->image) {
            $storedImage =  $this->image->store('public/customerphotos');
        }

        $customer->customerDetails()->create([
            'phone' => $this->phone,
            'address' => $this->address,
            'msp' => $this->msp,
            'msp_type' => $this->msp_type,
            'profit_margin' => $this->profit_margin,
            'profit_margin_type' => $this->profit_margin_type,
            'image' => $storedImage,
        ]);

        $this->reset('name');
        $this->reset('email');
        $this->reset('phone');
        $this->reset('password');
        $this->reset('address');
        $this->reset('msp');
        $this->reset('msp_type');
        $this->reset('profit_margin');
        $this->reset('profit_margin_type');
        $this->reset('image');
        $this->reset('parent_user');

        Bouncer::refresh();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function mount()
    {
        $this->parent_users = User::whereStatus(true)->whereIs('ueuser')->select(['id', 'name'])->get();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.customer.create');
    }
}
