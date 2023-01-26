<?php

namespace App\Http\Livewire\Admin\Surcharge;

use App\Models\Integrators\Integrator;
use App\Models\Surcharge\Surcharge;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Edit extends Component
{

    public Surcharge $surcharge;

    public $integrators;

    protected function rules()
    {
        return [
            'surcharge.name' => 'required',
            'surcharge.rate' => 'required',
            'surcharge.rate_type' => 'required',
            'surcharge.type' => 'required',
            'surcharge.status' => 'required',
            'surcharge.integrator_id' => 'required',
            'surcharge.start_weight' => 'required',
            'surcharge.end_weight' => 'required',
            'surcharge.applied_for' => 'required',
            'surcharge.applied_for_id' => 'required',
            'surcharge.sort_order' => 'required',
            'surcharge.start_date' => 'required',
            'surcharge.end_date' => 'required',
            'surcharge.per_weight' => 'nullable',
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
        $this->integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });
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
