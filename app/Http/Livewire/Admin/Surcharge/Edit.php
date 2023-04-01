<?php

namespace App\Http\Livewire\Admin\Surcharge;

use App\Models\Integrators\Integrator;
use App\Models\Surcharge\Surcharge;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class Edit extends Component
{

    public Surcharge $surcharge;

    public $integrators;

    public $applied_for_txt = "&nbsp;";
    public $applied_for_items = NULL;


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
        $this->dispatchBrowserEvent('contentChanged');
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if ($this->surcharge->applied_for == 'zone') {
            $this->getZones();
        }
        return view('livewire.admin.surcharge.edit');
    }

    public function getZones()
    {
        // dd($this->surcharge->integrator_id);
        $this->applied_for_items = Zone::where('type', $this->surcharge->type)->where('integrator_id', $this->surcharge->integrator_id)->select('zone_code as name', 'zone_code as id')->distinct('zone_code')->get();
        // dd($this->applied_for_items);
        if ($this->applied_for_items->count()) {
            $this->surcharge->applied_for_id = $this->applied_for_items->first()->id;
        }
    }

    public function updatedSurchargeIntegratorId()
    {
        if ($this->surcharge->applied_for == 'zone') {
            $this->getZones();
        }
    }

    public function updatedSurchargeType()
    {
        if ($this->surcharge->applied_for == 'zone') {
            $this->getZones();
        }
    }

    // public function updatedSurchargeAppliedForId($value){
    //     dd($value);
    //     $this->surcharge->applied_for_id = $value;
    //     $this->surcharge->save();
    // }

    public function updatedSurchargeAppliedFor($value)
    {
        if ($value == 'zone') {
            $this->applied_for_txt = "Select Zone";
            $this->getZones();
        } else if ($value == 'country') {
            $this->applied_for_txt = "Select Country";
            $this->applied_for_items = Country::all();
            $this->surcharge->applied_for_id = 1;
        } else {
            $this->applied_for_txt = "&nbsp;";
            $this->applied_for_items = NULL;
            $this->surcharge->applied_for_id = 0;
        }
    }
}
