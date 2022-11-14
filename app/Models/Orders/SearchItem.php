<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'search_id',
        'length',
        'height',
        'width',
        'weight',
    ];

    public function search()
    {
        return $this->belongsTo(Search::class);
    }
}
