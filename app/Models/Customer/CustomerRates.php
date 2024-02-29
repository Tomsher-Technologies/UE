<?php

namespace App\Models\Customer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerRates extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'integrator_id',
        'zone',
        'type',
        'weight',
        'end_weight',
        'rate',
        'pac_type',
    ];
    
}
