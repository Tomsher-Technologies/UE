<?php

namespace App\Http\Livewire\Admin\SpecialRates;

use App\Models\SpecialRate;
use Livewire\Component;

class Edit extends Component
{

    public SpecialRate $rate;

    public function mount($specialRate)
    {
        $this->rate = $specialRate;
    }

    protected function rules()
    {
        return [
            'rate.name' => 'required',
            'rate.approved_rate' => 'required',
            'rate.rate_type' => 'required',
            'rate.status' => 'required',
            'rate.expiry_date' => 'required',
        ];
    }

    protected $messages = [
        'rate.name.required' => 'Please enter a name',
        'rate.rate.required' => 'Please enter a rate',
        'rate.rate_type.required' => 'Please enter a type',
    ];

    public function save()
    {
        $validatedData = $this->validate();

        $this->rate->save();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.special-rates.edit');
    }
}
