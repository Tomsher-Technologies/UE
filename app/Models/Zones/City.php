<?php

namespace App\Models\Zones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
