<?php

namespace App\Http\Livewire\Admin\Integrator;

use App\Models\Integrators\Integrator;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Integrator $integrator;
    public $image;
    public $c_image;

    protected function rules()
    {
        return [
            'integrator.name' => 'required',
            'integrator.email' => 'nullable',
            'integrator.phone' => 'nullable',
            'integrator.address' => 'nullable',
            'integrator.integrator_code' => 'nullable',
        ];
    }

    protected $messages = [
        'user.name.required' => 'Please enter a name',
        'integrator.email.email' => 'The email address format is not valid.',
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


    public function mount($integrator)
    {
        $this->integrator = $integrator;
    }

    public function save()
    {
        $validatedData = $this->validate();

        if ($this->image) {
            $storedImage =  $this->image->store('public/ingetrators');

            if (Storage::exists($this->integrator->logo)) {
                Storage::delete($this->integrator->logo);
            }

            $this->integrator->logo =  $storedImage;
            $this->reset('image');
        }

        $this->integrator->save();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function render()
    {
        $this->c_image = $this->integrator->getLogoImage();
        return view('livewire.admin.integrator.edit');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
