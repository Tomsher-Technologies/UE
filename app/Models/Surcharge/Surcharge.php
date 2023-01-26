<?php

namespace App\Models\Surcharge;

use App\Models\Integrators\Integrator;
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
        'type',
        'status',
        'start_date',
        'per_weight',
        'end_date',
        'sort_order',
    ];

    protected $casts = [
        'start_date' => 'date:Y-m-d',
        'end_date' => 'date:Y-m-d',
    ];

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }
}
