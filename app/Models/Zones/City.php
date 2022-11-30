<?php

namespace App\Models\Zones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $fillable = [
        'city',
        'country_id',
        'is_remote',
        'pincode',
        'state',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'code', 'country_code');
    }
}
