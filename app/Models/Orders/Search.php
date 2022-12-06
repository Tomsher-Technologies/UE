<?php

namespace App\Models\Orders;

use App\Models\SpecialRate;
use App\Models\User;
use App\Models\Zones\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;

    protected $fillable  = [
        'user_id',
        'from_country',
        'from_city',
        'from_pin',
        'to_country',
        'to_city',
        'to_pin',
        'number_of_pieces',
        'search_hash',
        'shipment_type',
        'package_type',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SearchItem::class);
    }

    public function specialRate()
    {
        return $this->hasOne(SpecialRate::class);
    }
    public function activeSpecialRate()
    {
        return $this->specialRate()->where('status', 1);
    }

    public function toCountry()
    {
        return $this->belongsTo(Country::class, 'to_country');
    }
    public function fromCountry()
    {
        return $this->belongsTo(Country::class, 'from_country');
    }
}
