<?php

namespace App\Models;

use App\Models\Orders\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Wildside\Userstamps\Userstamps;

class SpecialRate extends Model
{
    use HasFactory, Userstamps;

    protected $fillable = [
        'approval_date',
        'approved_rate',
        'expiry_date',
        'integrator_id',
        'original_rate',
        'rate_type',
        'request_date',
        'request_rate',
        'search_id',
        'status',
        'total_weight',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function searh()
    {
        return $this->belongsTo(Search::class);
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
