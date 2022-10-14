<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer\ProfitMargin as CustomerProfitMargin;
use App\Models\Integrators\Integrator;
use App\Models\User;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Livewire\Component;

class   ProfitMargin extends Component
{
    public User $user;
    public $integrators;


    public $applied_for_txt = "&nbsp;";
    public $applied_for_items = NULL;

    // 
    public $type = 'import';
    public $integrator;
    public $rate_type = 'percentage';
    public $rate;
    public $applied_for = 'all';
    public $applied_for_id;

    public function mount($user)
    {
        $this->user = $user;
        $this->integrators = Integrator::all();
        $this->integrator = $this->integrators->first()->id;
    }

    public function deleteRate($id)
    {
        $status = CustomerProfitMargin::where('id', $id)->first()->delete();
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
        if ($this->applied_for == 'zones') {
            $this->getZones();
        }
    }

    public function updatedType()
    {
        if ($this->applied_for == 'zones') {
            $this->getZones();
        }
    }

    public function updatedAppliedFor($value)
    {
        if ($value == 'zones') {
            $this->applied_for_txt = "Select Zone";
            $this->getZones();
        } else if ($value == 'countries') {
            $this->applied_for_txt = "Select Country";
            $this->applied_for_items = Country::all();
        } else {
            $this->applied_for_txt = "&nbsp;";
            $this->applied_for_items = NULL;
        }
    }

    public function render()
    {
        if ($this->applied_for == 'zones') {
            $this->getZones();
        }
        $margins = $this->user->profitmargin()->get();
        $margins->load('integrator');
        // dd($margins);
        return view('livewire.admin.customer.profit-margin')->with([
            'margins' => $margins
        ])->extends('layouts.admin');
    }
}
