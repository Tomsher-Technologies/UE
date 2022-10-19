<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->hasMany(User::class);
    }

    public function profitmargin()
    {
        return $this->morphMany(ProfitMargin::class, 'profitmargin');
    }
}
