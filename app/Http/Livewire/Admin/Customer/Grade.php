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

    public $editData;

    public $name;

    protected function rules()
    {
        return [
            'editData.name' => 'required',
        ];
    }

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

    public function edit($id)
    {
        $this->editData = CustomerGrade::where('id', $id)->first();
        $this->dispatchBrowserEvent('editModal');
    }

    public function update()
    {
        $this->editData->save();
        $this->reset('editData');
        $this->dispatchBrowserEvent('modelUpdated');
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|unique:grades,name',
        ], [
            'name.required' => 'Please enter a name',
        ]);
        $grade = CustomerGrade::create([
            'name' => $this->name
        ]);
        $this->reset('name');
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

    public function updatingSearch()
    {
        $this->resetPage();
    }
}
