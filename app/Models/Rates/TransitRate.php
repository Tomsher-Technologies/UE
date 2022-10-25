<?php

namespace App\Models\Rates;

use App\Models\Integrators\Integrator;
use App\Models\Zones\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitRate extends Model
{
    use HasFactory;

    protected $fillable = [
        'integrator_id',
        'rate',
        'weight',
        'zone_id',
    ];
    
    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }
}
