<?php

namespace App\Models\Customer;

use App\Models\Integrators\Integrator;
use App\Models\Zones\Country;
use App\Models\Zones\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfitMargin extends Model
{
    use HasFactory;

    protected $fillable = [
        'applied_for',
        'applied_for_id',
        'integrator_id',
        'profitmargin_id',
        'profitmargin_type',
        'rate',
        'rate_type',
        'type',
        'weight',
    ];

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }

    public function profitmargin()
    {
        return $this->morphTo();
    }

    public function getAppliedFor()
    {
        $val = "- ";
        if ($this->applied_for == 'zone') {
            return $val . $this->applied_for_id;
        } else if ($this->applied_for == 'country') {
            return $val . Country::where('id', $this->applied_for_id)->get()->first()->name;
        }
        return "";
    }
}
