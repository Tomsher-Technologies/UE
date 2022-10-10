<?php

namespace App\Http\Livewire\Admin\Surcharge;

use App\Models\Surcharge\Surcharge;
use Livewire\Component;

class Edit extends Component
{

    public Surcharge $surcharge;

    protected function rules()
    {
        return [
            'surcharge.name' => 'required',
            'surcharge.rate' => 'required',
            'surcharge.rate_type' => 'required',
            'surcharge.status' => 'required',
        ];
    }

    protected $messages = [
        'surcharge.name.required' => 'Please enter a name',
        'surcharge.rate.required' => 'Please enter a rate',
        'surcharge.rate_type.required' => 'Please enter a type',
    ];

    public function save()
    {
        $validatedData = $this->validate();

        $this->surcharge->save();
        
        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function mount($surcharge)
    {
        $this->surcharge = $surcharge;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.surcharge.edit');
    }
}
