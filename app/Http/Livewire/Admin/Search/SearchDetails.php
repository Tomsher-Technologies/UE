<?php

namespace App\Http\Livewire\Admin\Search;

use App\Models\Orders\Search;
use Livewire\Component;

class SearchDetails extends Component
{

    public $search;

    public function mount($search)
    {
        $this->search = Search::findOrFail($search);
        $this->search->load([
            'user',
            'fromCountry',
            'toCountry',
            'items',
        ]);
        // dd($this->search);
    }

    public function render()
    {
        return view('livewire.admin.search.search-details')->extends('layouts.admin');
    }
}
