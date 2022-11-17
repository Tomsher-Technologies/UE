<?php

namespace App\Models\Orders;

use App\Models\Integrators\Integrator;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable  = [
        'user_id',
        'integrator_id',
        'search_id',
        'shipper_name',
        'shipper_phone',
        'shipper_address',
        'consignee_name',
        'consignee_email',
        'consignee_phone',
        'consignee_address',
        'consignee_town',
        'consignee_province',
        'item_name',
        'hawbNumber',
        'invoice_url',
        'order_status',
        'rate',
        'billable_weight',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function integrator()
    {
        return $this->belongsTo(Integrator::class);
    }

    public function search()
    {
        return $this->belongsTo(Search::class);
    }

    public function status_text()
    {
        if ($this->order_status == 1) {
            return "Successful";
        } else {
            return "Failed";
        }
    }
}
