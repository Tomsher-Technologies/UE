<?php

namespace App\Models\Zones;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    protected $table = 'cities_2';

    protected $fillable = [
        'city',
        'country_id',
        'is_remote',
        'zip_to',
        'pincode',
        'state',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class, 'code', 'country_code');
    }
}
