<?php

namespace App\Models\Integrators;

use App\Models\Rates\ExportRate;
use App\Models\Rates\ImportRate;
use App\Models\Rates\TransitRate;
use App\Models\Zones\Zone;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Integrator extends Model
{
    use HasFactory;

    protected $guraded = ['id'];

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
}
