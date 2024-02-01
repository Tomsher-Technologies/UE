<?php

namespace App\Http\Livewire\Admin\Surcharge;

use App\Models\Integrators\Integrator;
use App\Models\Surcharge\Surcharge;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Create extends Component
{
    public $name;
    public $rate;
    public $is_fsc = 0;
    public $rate_type = 1;
    public $status = 1;
    public $sort_order = 0;
    public $per_weight = false;
    public $integrator = 0;
    public $start_weight;
    public $end_weight;
    public $start_date;
    public $end_date;
    public $type = 'all';

    public $applied_for = 'all';
    public $applied_for_id = 0;

    public $applied_for_txt = "&nbsp;";
    public $applied_for_items = NULL;

    public $integrators;

    protected function rules()
    {
        return [
            'type' => 'required',
            'name' => 'required',
            'rate' => 'required',
            'rate_type' => 'required',
            'integrator' => 'nullable',
            'start_weight' => 'required',
            'end_weight' => 'required|gte:start_weight',
            'applied_for' => 'required',
            'applied_for_id' => 'nullable',
        ];
    }

    protected $messages = [
        'type.required' => 'Please enter a type',
        'name.required' => 'Please enter a name',
        'rate.required' => 'Please enter a rate',
        'rate_type.required' => 'Please enter a type',
        'end_weight.gte' =>  "The end weight must be greater than start weight."
    ];

    public function mount()
    {
        $this->integrators = Cache::rememberForever('integrators', function () {
            return Integrator::all();
        });
        $this->integrator = 0;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $start_date = NULL;
        $end_date = NULL;

        if ($this->start_date && $this->start_date !== '' || $this->start_date !== NULL) {
            $start_date = $this->start_date;
            if ($this->end_date && $this->end_date !== '' || $this->end_date !== NULL) {
                $end_date = $this->end_date;
            }
        }

        $surchareg = Surcharge::create([
            'integrator_id' => $this->integrator,
            'name' => $this->name,
            'rate' => $this->rate,
            'is_fsc' => $this->is_fsc,
            'start_weight' => $this->start_weight,
            'end_weight' => $this->end_weight,
            'rate_type' => $this->rate_type,
            'status' => $this->status,
            'applied_for' => $this->applied_for,
            'applied_for_id' => $this->applied_for_id,
            'type' => $this->type,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'per_weight' => $this->per_weight,
            'sort_order' => $this->sort_order,
        ]);

        $this->reset('sort_order');
        $this->reset('per_weight');
        $this->reset('integrator');
        $this->reset('is_fsc');
        $this->reset('rate');
        $this->reset('name');
        $this->reset('start_weight');
        $this->reset('applied_for_id');
        $this->reset('end_weight');
        $this->reset('start_date');
        $this->reset('end_date');
        $this->applied_for = 'all';
        $this->type = 'all';
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
        $this->dispatchBrowserEvent('contentChanged');
        $this->validateOnly($propertyName);
    }

    public function getZones()
    {
        $this->applied_for_items = Zone::where('type', $this->type)->where('integrator_id', $this->integrator)->select('zone_code as name', 'zone_code as id')->distinct('zone_code')->get();
        if ($this->applied_for_items->count()) {
            $this->applied_for_id = $this->applied_for_items->first()->id;
        }
    }

    public function updatedIntegrator()
    {
        if ($this->applied_for == 'zone') {
            $this->getZones();
        }
    }

    public function updatedType()
    {
        if ($this->applied_for == 'zone') {
            $this->getZones();
        }
    }

    public function updatedAppliedFor($value)
    {
        if ($value == 'zone') {
            $this->applied_for_txt = "Select Zone";
            $this->getZones();
        } else if ($value == 'country') {
            $this->applied_for_txt = "Select Country";
            $this->applied_for_items = Country::all();
            $this->applied_for_id = 1;
        } else {
            $this->applied_for_txt = "&nbsp;";
            $this->applied_for_items = NULL;
            $this->applied_for_id = 0;
        }
    }
}
