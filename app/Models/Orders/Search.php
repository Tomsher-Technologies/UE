<?php

namespace App\Models\Orders;

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
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SearchItem::class);
    }
}
