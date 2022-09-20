<?php

namespace App\Http\Livewire\Admin\Integrator;

use App\Models\Integrators\Integrator;
use Livewire\Component;

class Create extends Component
{

    public $name;
    public $email;
    public $phone;
    public $integrator_code;
    public $address;

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

    public function save()
    {
        $validatedData = $this->validate();

        $integrator = Integrator::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'integrator_code' => $this->integrator_code,
            'address' => $this->address,
        ]);

        $this->reset('name');
        $this->reset('email');
        $this->reset('integrator_code');
        $this->reset('phone');
        $this->reset('address');
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
