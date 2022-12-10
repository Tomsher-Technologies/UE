<?php

namespace App\Models\Surcharge;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Surcharge extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'name',
        'integrator_id',
        'start_weight',
        'end_weight',
        'applied_for',
        'applied_for_id',
        'rate',
        'rate_type',
        'status',
    ];
}
