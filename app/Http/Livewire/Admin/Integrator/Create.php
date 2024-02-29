<?php

namespace App\Http\Livewire\Admin\Integrator;

use App\Models\Integrators\Integrator;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $email;
    public $phone;
    public $address;
    public $service_code;

    public $image;

    protected function rules()
    {
        return [
            'name' => 'required',
            'service_code' => 'required',
            // 'email' => ['nullable', 'email'],
            // 'phone' => ['nullable'],
            // 'address' => ['nullable'],
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter a name',
        'service_code.required' => 'Please enter a HubEz service code',
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
            'integrator_code' => $this->getIntegratorCode($this->name),
            // 'email' => $this->email,
            // 'phone' => $this->phone,
            // 'address' => $this->address,
            'logo' => $storedImage,
            'service_code' => $this->service_code
        ]);

        $this->reset('name');
        // $this->reset('email');
        // $this->reset('phone');
        // $this->reset('address');
        $this->reset('image');
        $this->reset('service_code');
        Cache::forget('integrators');
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

    public function getIntegratorCode($name)
    {
        $code = strtolower($name);
        $code = str_replace(' ', '', $code);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $code);
    }
}
