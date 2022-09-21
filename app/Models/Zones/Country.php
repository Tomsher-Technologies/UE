<?php

namespace App\Models\Zones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function city()
    {
        return $this->hasMany(City::class);
    }

    public function zone()
    {
        return $this->belongsToMany(Zone::class);
    }
}
