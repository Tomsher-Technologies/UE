<?php

namespace App\Models\Orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SearchItem extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function search()
    {
        return $this->belongsTo(Search::class);
    }
}
