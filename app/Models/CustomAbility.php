<?php

namespace App\Models;

use Silber\Bouncer\Database\Ability;

class CustomAbility extends Ability
{
    protected $fillable = [
        'name',
        'title',
        'group',
    ];
}
