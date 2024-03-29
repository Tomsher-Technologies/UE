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

    protected $fillable = [
        'country_id',
        'integrator_id',
        'type',
        'zone_code',
        'is_remote',
        'remote_rate',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }
}
