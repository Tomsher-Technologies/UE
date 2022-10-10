<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class SpecialRate extends Model
{
    use HasFactory, Userstamps;

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        if ($this->status == 0) {
            return "Pending";
        } elseif ($this->status == 1) {
            return "Approved";
        } elseif ($this->status == 2) {
            return "Rejected";
        } else {
            return "Expired";
        }
    }

    protected $casts = [
        'request_date' => 'datetime',
        'approval_date' => 'datetime',
        'expiry_date' => 'date:Y-m-d',
    ];

}
