<?php

namespace App\Http\Livewire\Admin\Customer\Grade;

use App\Models\Customer\Grade;
use App\Models\Customer\ProfitMargin;
use App\Models\Integrators\Integrator;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Livewire\Component;

class GradeProfitMargin extends Component
{

    public Grade $element;
    public $integrators;

    public $applied_for_txt = "&nbsp;";
    public $applied_for_items = NULL;

    // 
    public $start_date;
    public $type = 'all';
    public $integrator = 0;
    public $rate_type = 'percentage';
    public $rate;
    public $weight;
    public $end_weight;
    public $applied_for = 'all';
    public $applied_for_id = '0';
    public $product_type = 'all';

    protected function rules()
    {
        return [
            'type' => 'required',
            'integrator' => 'required',
            'rate_type' => 'required',
            'rate' => ['required'],
            'product_type' => ['required'],
            'start_date' => ['nullable'],
            'weight' => ['required'],
            'end_weight' => ['required'],
            'applied_for' => ['required'],
            'applied_for_id' => ['required'],
        ];
    }

    protected $messages = [
        'type.required' => 'Please enter a type',
        'integrator.required' => 'Please enter a integrator',
        'rate_type.required' => 'Please enter a type',
        'rate.required' => 'Please enter a rate',
        'weight.required' => 'Please enter a weight',
        'end_weight.required' => 'Please enter a weight',
    ];

    public function mount($grade)
    {
        $this->element = Grade::findOrFail($grade);
        $this->integrators = Integrator::all();
        // $this->integrator = $this->integrators->first()->id;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $this->element->profitmargin()->create([
            'type' => $this->type,
            'integrator_id' => $this->integrator,
            'applied_for' => $this->applied_for,
            'applied_for_id' => $this->applied_for_id,
            'weight' => $this->weight,
            'end_weight' => $this->end_weight,
            'rate_type' => $this->rate_type,
            'rate' => $this->rate,
            'product_type' => $this->product_type,
            'start_date' => $this->start_date,
        ]);

        $this->reset('type');
        $this->reset('integrator');
        $this->reset('rate_type');
        $this->reset('rate');
        $this->reset('weight');
        $this->reset('end_weight');
        $this->reset('applied_for');
        $this->reset('applied_for_id');
        $this->reset('applied_for_txt');
        $this->reset('applied_for_items');
        $this->reset('product_type');
        $this->reset('start_date');

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function deleteRate($id)
    {
        $status = ProfitMargin::where('id', $id)->first()->delete();
        if ($status) {
            $this->dispatchBrowserEvent('modelDeleted');
        } else {
            $this->dispatchBrowserEvent('modelDeletedFailed');
        }
    }

    public function getZones()
    {
        $this->applied_for_items = Zone::where('type', $this->type)->where('integrator_id', $this->integrator)->select('zone_code as name', 'zone_code as id')->distinct('zone_code')->get();
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
        } else {
            $this->applied_for_txt = "&nbsp;";
            $this->applied_for_items = NULL;
            $this->applied_for_id = 0;
        }
    }

    public function render()
    {
        if ($this->applied_for == 'zones') {
            $this->getZones();
        }
        $margins = $this->element->profitmargin()->get();
        $margins->load('integrator');
        return view('livewire.admin.customer.grade.grade-profit-margin')->with([
            'margins' => $margins
        ])->extends('layouts.admin');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }
}
