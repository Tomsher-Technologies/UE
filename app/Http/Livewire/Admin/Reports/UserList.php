<?php

namespace App\Http\Livewire\Admin\Reports;

use App\Models\Customer\Grade;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class UserList extends Component
{

    use WithPagination;

    public $search = "";
    public $pageCount = 15;
    public $sortBy = 'name';
    public $sortOrder = 'DESC';

    public $grades;
    public $selectedGrade = "0";

    public function mount()
    {
        $this->grades = Grade::all();
    }

    public function render()
    {

        // DB::enableQueryLog();

        $query = User::query();

        if ($this->search !== "") {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('email', 'LIKE', '%' . $this->search . '%');
        }

        if ($this->selectedGrade !== "0") {
            $query->where('grade_id', $this->selectedGrade);
        }

        $query->whereIs('reseller')->with('customerDetails')->withCount(['searches', 'orders'])->orderBy($this->sortBy, $this->sortOrder);

        $users = $query->paginate($this->pageCount);

        // dd(DB::getQueryLog());

        return view('livewire.admin.reports.user-list')->with([
            'users' => $users
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
