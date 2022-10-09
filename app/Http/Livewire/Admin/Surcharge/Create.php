<?php

namespace App\Http\Livewire\Admin\Surcharge;

use App\Models\Surcharge\Surcharge;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $rate;
    public $rate_type = 1;
    public $status = 1;

    protected function rules()
    {
        return [
            'name' => 'required',
            'rate' => 'required',
            'rate_type' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter a name',
        'rate.required' => 'Please enter a rate',
        'rate_type.required' => 'Please enter a type',
    ];

    public function save()
    {
        $validatedData = $this->validate();

        $surchareg = Surcharge::create([
            'name' => $this->name,
            'rate' => $this->rate,
            'rate_type' => $this->rate_type,
            'status' => $this->status,
        ]);

        $this->reset('name');
        $this->reset('rate');
        $this->rate_type = 1;
        $this->status = 1;

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function render()
    {
        return view('livewire.admin.surcharge.create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
