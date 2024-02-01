<?php

namespace App\Http\Livewire\Admin\Integrator;

use App\Models\Integrators\Integrator;
use Livewire\Component;

class Export extends Component
{

    public $export_by = 'integrator';

    public $integrator = 0;
    public $type = 'import';
    public $weight = .5;

    public function render()
    {
        $integrators = Integrator::all();
        return view('livewire.admin.integrator.export')->with([
            'integrators' => $integrators
        ]);
    }
}
