<?php

namespace App\Http\Livewire\Admin\Customer;

use App\Models\Customer\Grade;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Bouncer;

class Create extends Component
{
    use WithFileUploads;


    public $name;
    public $email;
    public $phone;
    public $password;
    public $address;
    public $msp = 0;
    public $request_limit;
    public $limit_weight;
    public $msp_type = 'percentage';
    public $credit_limit;

    public $parent_users;
    public $parent_user = 0;

    public $grade = 1;
    public $is_sales = 0;
    public $grades;

    public $rate_sheet_status;

    public $image;

    protected function rules()
    {
        return [
            'password' => 'required',
            'parent_user' => 'nullable',
            'credit_limit' => 'nullable',
            'name' => 'required',
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'address' => ['nullable'],
            'msp' => ['nullable', 'integer'],
            'msp_type' => ['nullable'],
            'msp_type' => ['nullable'],
            'request_limit' => ['nullable'],
            'limit_weight' => ['nullable'],
            'rate_sheet_status' => ['required'],
        ];
    }

    protected $messages = [
        'password.required' => 'Please enter a password',
        'parent_user.required' => 'Please select a assigned UE user',
        'name.required' => 'Please enter a name',
        'email.email' => 'The email address format is not valid.',
        'email.required' => 'The email address is required.',
    ];


    public function updatedPhoto()
    {
        $this->validate([
            'image' => 'file|mimes:png,jpg,jpeg,gif,webp|max:1024', // 1MB Max
        ], [
            'image.file' => "Please select valid image",
            'image.mimes' => "Please select valid .jpg, .jpeg, .png, .gif, .webp image",
            'image.uploaded' => "Image size can't be bigger than 1MB",
            'image.max' => "Image size can't be bigger than 1MB",
        ]);
    }

    public function save()
    {
        $validatedData = $this->validate();

        $customer = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'status' => 1,
            'verified' => 1,
            'parent_id' => $this->parent_user,
            'grade_id' => $this->grade,
            'is_sales' => $this->is_sales,
        ]);

        Bouncer::assign('reseller')->to($customer);

        $storedImage = NULL;
        if ($this->image) {
            $storedImage =  $this->image->store('public/customerphotos');
        }

        $customer->customerDetails()->create([
            'phone' => $this->phone,
            'address' => $this->address,
            'msp' => $this->msp !== "" ? $this->msp : NULL,
            'msp_type' => $this->msp_type,
            'image' => Str::remove('public/', $storedImage),
            'request_limit' => $this->request_limit == '' ? 0 : $this->request_limit,
            'limit_weight' => $this->limit_weight == '' ? 0 : $this->limit_weight,
            'rate_sheet_status' => $this->rate_sheet_status,
            'credit_limit' => $this->credit_limit,
        ]);

        if ($this->rate_sheet_status == "1") {
            $customer->allow('download-rate-sheet');
        }

        $this->reset('name');
        $this->reset('email');
        $this->reset('phone');
        $this->reset('password');
        $this->reset('address');
        $this->reset('msp');
        $this->reset('msp_type');
        $this->reset('image');
        $this->reset('parent_user');
        $this->reset('grade');
        $this->reset('request_limit');
        $this->reset('limit_weight');
        $this->reset('rate_sheet_status');

        Bouncer::refresh();

        return redirect()->route('admin.customer.profitMargin', ['user' =>  $customer]);

        $this->dispatchBrowserEvent('memberUpdated');
    }

    public function mount()
    {
        $this->grades = Grade::all();
        $this->parent_users = User::whereStatus(true)->whereIs('ueuser')->select(['id', 'name'])->get();
        $this->rate_sheet_status = 1;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.customer.create');
    }
}
