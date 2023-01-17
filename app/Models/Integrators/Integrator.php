<?php

namespace App\Models\Integrators;

use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\OverWeightRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\OdPincodes;
use App\Models\Zones\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class Integrator extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'address',
        'email',
        'integrator_code',
        'logo',
        'name',
        'service_code',
    ];

    public function zone()
    {
        return $this->hasMany(Zone::class);
    }

    public function importRate()
    {
        return $this->hasMany(ImportRate::class);
    }
    public function exportRate()
    {
        return $this->hasMany(ExportRate::class);
    }

    public function transitRate()
    {
        return $this->hasMany(TransitRate::class);
    }

    public function overWeightRate()
    {
        return $this->hasMany(OverWeightRate::class);
    }

    public function uploads()
    {
        return $this->hasMany(Uploads::class);
    }

    public function getLogoImage()
    {
        return $this->logo ? URL::to('storage' . Str::remove('public', $this->logo)) : NULL;
    }

    public function odpincodes()
    {
        return $this->hasMany(OdPincodes::class);
    }
}
