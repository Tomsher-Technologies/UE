<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\User;
use Livewire\Component;

class Show extends Component
{

    public User $user;

    public function mount($user)
    {
        $this->user = $user;
        $this->user->load('customerDetails');
    }

    public function render()
    {
        return view('livewire.admin.customer.show');
    }
}
