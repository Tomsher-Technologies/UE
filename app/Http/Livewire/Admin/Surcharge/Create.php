<?php

namespace App\Http\Livewire\Admin\Surcharge;

use App\Models\Integrators\Integrator;
use App\Models\Surcharge\Surcharge;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $rate;
    public $rate_type = 1;
    public $status = 1;
    public $integrator_id;
    public $start_weight;
    public $end_weight;
    public $applied_for;
    public $applied_for_id;

    public $integrators;

    protected function rules()
    {
        return [
            'name' => 'required',
            'rate' => 'required',
            'rate_type' => 'required',
            'integrator_id' => 'required',
            'start_weight' => 'required',
            'end_weight' => 'required',
            'applied_for' => 'required',
            'applied_for_id' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter a name',
        'rate.required' => 'Please enter a rate',
        'rate_type.required' => 'Please enter a type',
    ];

    public function mount()
    {
        $this->integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });
        $this->integrator_id = $this->integrators->first()->id;

        

    }

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
        if ($this->applied_for == 'zone') {
            $this->getZones();
        }

        return view('livewire.admin.surcharge.create');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
