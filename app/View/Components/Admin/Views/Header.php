<?php

namespace App\View\Components\Admin\Views;

use App\Models\SpecialRate;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $specialrate = SpecialRate::limit(5)->latest()->with('user')->get();
        // dd($specialrate);
        return view('components.admin.views.header');
    }
}
