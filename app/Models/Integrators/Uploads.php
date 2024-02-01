<?php

namespace App\Models\Integrators;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\URL;
use Wildside\Userstamps\Userstamps;

class Uploads extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'integrator_id',
        'name',
        'path',
        'type',
    ];

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }

    public function getDownloadURL()
    {
        return URL::to($this->path);
    }
}
