<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class CustomerDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'image',
        'limit_weight',
        'msp',
        'msp_type',
        'phone',
        'profit_margin',
        'profit_margin_type',
        'request_limit',
        'user_id',
        'rate_sheet_status',
        'address_2',
        'city',
        'country',
        'vat_number',
        'account_number',
        'company_name',
    ];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function getProfileImage()
    {
        return $this->image ? URL::to('storage/' . $this->image) : NULL;
    }
}
