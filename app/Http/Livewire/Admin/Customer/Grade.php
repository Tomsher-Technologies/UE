<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer\Grade as CustomerGrade;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Grade extends Component
{
    use WithPagination;

    public $search = "";
    public $pageCount = 15;

    public $name;
    public $msp_type = 'percentage';
    public $msp;
    public $profit_margin_type = 'percentage';
    public $profit_margin;

    protected function rules()
    {
        return [
            'name' => 'required|unique:grades,name',
            'msp_type' => 'required',
            'msp' => 'required',
            'profit_margin_type' => 'required',
            'profit_margin' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter a name',
        'msp_type.required' => 'Please enter a msp type',
        'msp.required' => 'Please enter a msp',
        'profit_margin_type.required' => 'Please enter a profit margin type',
        'profit_margin.required' => 'Please enter profit margin',
    ];

    public function deleteGrade($id)
    {
        $grade = CustomerGrade::where('id', $id)->first();

        if ($grade->id != 1) {

            User::where('grade_id', $id)
                ->update([
                    'grade_id' => 1
                ]);

            if ($grade->delete()) {
                $this->dispatchBrowserEvent('modelDeleted');
            } else {
                $this->dispatchBrowserEvent('modelDeletedFailed');
            }
        } else {
            $this->dispatchBrowserEvent('modelNoDelete');
        }
    }

    public function save()
    {
        $validatedData = $this->validate();
        $grade = CustomerGrade::create($validatedData);
        $this->reset('name');
        $this->reset('msp_type');
        $this->reset('msp');
        $this->reset('profit_margin_type');
        $this->reset('profit_margin');
        $this->dispatchBrowserEvent('modelCreated');
    }

    public function render()
    {
        $query = CustomerGrade::latest();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%');
        }

        $grades = $query->paginate($this->pageCount);

        return view('livewire.admin.customer.grade')->with([
            'grades' => $grades
        ])->extends('layouts.admin');
    }

    public function paginationView()
    {
        return 'vendor.livewire.custom';
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
