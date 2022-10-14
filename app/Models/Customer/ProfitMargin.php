<?php

namespace App\Models\Customer;

use App\Models\Integrators\Integrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitMargin extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }

    public function profitmargin()
    {
        return $this->morphTo();
    }
}
