<?php

namespace App\Http\Livewire\Admin\Integrator;

use App\Models\Integrators\Integrator;
use Livewire\Component;

class Edit extends Component
{

    public Integrator $integrator;


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

    public function mount($integrator)
    {
        $this->integrator = $integrator;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $this->integrator->save();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function render()
    {
        return view('livewire.admin.integrator.edit');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
