<?php

namespace App\Http\Livewire\Admin\SpecialRates;

use App\Models\SpecialRate;
use App\Models\User;
use Livewire\Component;

class Create extends Component
{

    public User $user;
    public $name;
    public $approved_rate;
    public $rate_type = 1;
    public $expiry_date;
    public $status = 1;

    protected function rules()
    {
        return [
            'name' => 'required',
            'approved_rate' => ['nullable'],
            'rate_type' => ['required'],
            'expiry_date' => ['nullable'],
            'status' => ['required'],
        ];
    }

    protected $messages = [
        'name.required' => 'Please enter a name',
    ];


    public function mount($user)
    {
        $this->user = $user;
    }

    public function save()
    {
        $validatedData = $this->validate();

        $integrator = $this->user->specialrate()->create([
            'name' => $this->name,
            'approved_rate' => $this->approved_rate,
            'rate_type' => $this->rate_type,
            'expiry_date' => $this->expiry_date,
            'status' => $this->status,
        ]);

        $this->reset('name');
        $this->reset('approved_rate');
        $this->reset('rate_type');
        $this->reset('expiry_date');
        $this->reset('status');
        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.special-rates.create');
    }
}
