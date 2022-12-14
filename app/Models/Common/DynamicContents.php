<?php

namespace App\Models\Common;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DynamicContents extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'heading',
        'content',
        'status',
    ];
}
