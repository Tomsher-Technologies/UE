<?php

namespace App\Models\Surcharge;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class Surcharge extends Model
{
    use HasFactory, Userstamps;

    protected $guarded = ['id'];
}
