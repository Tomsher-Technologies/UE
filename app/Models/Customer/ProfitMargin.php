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

    protected $guarded = ['id'];

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
