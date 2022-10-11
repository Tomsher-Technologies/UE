<?php

namespace App\Models\Zones;

use App\Models\Integrators\Integrator;
use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function country()
    {
        return $this->hasOne(Country::class);
    }

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }
}
