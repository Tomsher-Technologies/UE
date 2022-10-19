<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer\Grade;
use Livewire\Component;

class GradeEdit extends Component
{

    public Grade $grade;

    protected function rules()
    {
        return [
            'grade.name' => 'required|unique:grades,name,' . $this->grade->id,
            'grade.msp_type' => 'required',
            'grade.msp' => 'required',
            'grade.profit_margin_type' => 'required',
            'grade.profit_margin' => 'required',
        ];
    }

    protected $messages = [
        'grade.name.required' => 'Please enter a name',
        'grade.msp_type.required' => 'Please enter a msp type',
        'grade.msp.required' => 'Please enter a msp',
        'grade.profit_margin_type.required' => 'Please enter a profit margin type',
        'grade.profit_margin.required' => 'Please enter profit margin',
    ];


    public function save()
    {
        $this->validate();

        $this->grade->save();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function mount($grade)
    {
        $this->grade = $grade;
    }

    public function render()
    {
        return view('livewire.admin.customer.grade-edit')->extends('layouts.admin');
    }
}
