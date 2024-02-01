<?php

namespace App\View\Components\Admin\Views;

use App\Models\SpecialRate;
use Carbon\Carbon;
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
        $specialrate = SpecialRate::where('status', 0)->whereBetween('request_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->limit(5)->latest()->with('user')->get();
        return view('components.admin.views.header')->with([
            'specialrates' => $specialrate
        ]);
    }
}
