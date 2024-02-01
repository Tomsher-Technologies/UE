<?php

namespace App\Http\Livewire\Admin\DynamicContent;

use App\Models\Common\DynamicContents;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $search;

    public function render()
    {

        $query = DynamicContents::latest();

        if ($this->search !== "") {
            $query->where('heading', 'LIKE', '%' . $this->search . '%');
        }

        $contents = $query->paginate(15);

        return view('livewire.admin.dynamic-content.index')->with([
            'contents' => $contents
        ]);
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
