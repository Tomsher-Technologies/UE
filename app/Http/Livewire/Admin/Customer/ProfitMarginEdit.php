<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer\ProfitMargin;
use App\Models\Integrators\Integrator;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Livewire\Component;

class ProfitMarginEdit extends Component
{

    public ProfitMargin $margin;

    public $integrators;

    public $applied_for_txt = "&nbsp;";
    public $applied_for_items = NULL;

    // 
    public $type = 'import';
    public $integrator_id;
    public $rate_type = 'percentage';
    public $rate;
    public $weight;
    public $end_weight;
    public $applied_for = 'all';
    public $applied_for_id;
 

    protected function rules()
    {
        return [
            'margin.type' => 'required',
            'margin.integrator_id' => 'required',
            'margin.rate_type' => 'required',
            'margin.rate' => ['required'],
            'margin.product_type' => ['required'],
            'margin.start_date' => ['nullable'],
            'margin.weight' => ['required', 'lt:margin.end_weight'],
            'margin.end_weight' => ['required', 'gte:margin.weight'],
            'margin.applied_for' => ['required'],
            'margin.applied_for_id' => ['required'],
        ];
    }

    protected $messages = [
        'margin.type.required' => 'Please ente a type',
        'margin.integrator_id.required' => 'Please ente a integrator',
        'margin.rate_type.required' => 'Please ente a type',
        'margin.rate.required' => 'Please ente a rate',
        'margin.weight.required' => 'Please ente a weight',
        'margin.end_weight.required' => 'Please ente a weight',
        'margin.end_weight.gte' =>  "The end weight must be greater than start weight."
    ];

    public function mount($profit_margin)
    {
        $this->margin = ProfitMargin::findOrFail($profit_margin);
        $this->integrators = Integrator::all();
        $this->countries = Country::all();
    }

    public function render()
    {
        if ($this->margin->applied_for == 'zone') {
            $this->getZones();
        } else if ($this->margin->applied_for == 'country') {
            $this->applied_for_items = $this->countries;
        }
        return view('livewire.admin.customer.profit-margin-edit')->extends('layouts.admin');
    }

    public function save()
    {
        $validatedData = $this->validate();
        $this->margin->save();
        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function getZones()
    {
        $this->applied_for_items = Zone::where('type', $this->margin->type)->where('integrator_id', $this->margin->integrator_id)->select('zone_code as name', 'zone_code as id')->distinct('zone_code')->get();
    }

    public function integratorUpdated()
    {
        if ($this->margin->applied_for == 'zone') {
            $this->getZones();
        }
    }

    public function typeUpdated()
    {
        if ($this->margin->applied_for == 'zone') {
            $this->getZones();
        }
    }

    public function appliedForUpdated($value)
    {
        if ($value == 'zone') {
            $this->applied_for_txt = "Select Zone";
            $this->getZones();
        } else if ($value == 'country') {
            $this->applied_for_txt = "Select Country";
            $this->applied_for_items = Country::all();
            $this->margin->applied_for_id = 1;
        } else {
            $this->applied_for_txt = "&nbsp;";
            $this->applied_for_items = NULL;
            $this->margin->applied_for_id = 0;
        }
    }

    public function updated($propertyName)
    {
        $this->dispatchBrowserEvent('contentChanged');
        $this->validateOnly($propertyName);
    }
}
