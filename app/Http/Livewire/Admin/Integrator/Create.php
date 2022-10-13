<?php

namespace App\Http\Livewire\Admin\Integrator;

use App\Models\Integrators\Integrator;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $integrator_code;
    public $address;

    public $image;

    protected function rules()
    {
        return [
            'name' => 'required',
            'email' => ['nullable', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'integrator_code' => ['nullable'],
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter a name',
        'email.email' => 'The email address format is not valid.',
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

        $storedImage = NULL;
        if ($this->image) {
            $storedImage =  $this->image->store('public/ingetrators');
        }

        $integrator = Integrator::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'integrator_code' => $this->integrator_code,
            'address' => $this->address,
            'logo' => $storedImage,
        ]);

        $this->reset('name');
        $this->reset('email');
        $this->reset('integrator_code');
        $this->reset('phone');
        $this->reset('address');
        $this->reset('image');
        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.integrator.create');
    }
}
