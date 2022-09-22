<?php

namespace App\Models\Rates;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransitRate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }
}
