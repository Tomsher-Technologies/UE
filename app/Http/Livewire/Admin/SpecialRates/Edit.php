<?php

namespace App\Http\Livewire\Admin\SpecialRates;

use App\Models\SpecialRate;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Edit extends Component
{

    public SpecialRate $rate;

    public function mount($specialRate)
    {
        $this->rate = $specialRate;
    }

    protected function rules()
    {
        return [
            'rate.approved_rate' => Rule::requiredIf($this->rate->status == 1),
            'rate.status' => 'required',
            // 'rate.rate_type' => 'required',
            // 'rate.expiry_date' => 'required',
        ];
    }

    protected $messages = [
        'rate.name.required' => 'Please enter a name',
        'rate.rate.required' => 'Please enter a rate',
        'rate.rate_type.required' => 'Please enter a type',
    ];

    public function save()
    {
        $validatedData = $this->validate();
        $this->rate->rate_type = 1;
        // dd($this->rate->approved_rate);
        
        if ($this->rate->approved_rate  == "" ||  $this->rate->approved_rate == NULL) {
            $this->rate->update([
                'approved_rate' => NULL
            ]);
        }

        if ($this->rate->status == 1) {
            $this->rate->approval_date = Carbon::now();
        }

        $this->rate->save();

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.special-rates.edit');
    }
}
