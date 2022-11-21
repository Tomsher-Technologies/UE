<?php

namespace App\Models\Zones;

use App\Models\Integrators\Integrator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OdPincodes extends Model
{
    use HasFactory;

    protected $fillable = [
        'integrator_id',
        'country_id',
        'pincode',
        'rate',
    ];

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
