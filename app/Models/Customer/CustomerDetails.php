<?php

namespace App\Models\Customer;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetails extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }
}
