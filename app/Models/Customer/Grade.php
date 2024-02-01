<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use HasFactory;

    protected $fillable = [
        'msp',
        'msp_type',
        'name',
        'profit_margin',
        'profit_margin_type',
    ];

    public function customer()
    {
        return $this->hasMany(User::class)->withTrashed();
    }

    public function profitmargin()
    {
        return $this->morphMany(ProfitMargin::class, 'profitmargin');
    }
}
