<?php

namespace App\Exports;

use App\Models\Orders\Order;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Str;

class OrderExport implements FromCollection, WithHeadings, WithMapping
{

    private $user_id;
    private $start_date;
    private $end_date;
    private $from_country_id;
    private $to_country_id;
    private $shipping_type;
    private $package_type;

    public function __construct(
        $user_id,
        $start_date,
        $end_date,
        $from_country_id,
        $to_country_id,
        $shipping_type,
        $package_type
    ) {
        $this->user_id = $user_id;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->from_country_id = $from_country_id;
        $this->to_country_id = $to_country_id;
        $this->shipping_type = $shipping_type;
        $this->package_type = $package_type;
    }

    public function map($order): array
    {
        return [
            Str::padLeft($order->id, 4, '0'),
            $order->user->name,
            $order->user->email,
            $order->search->fromCountry->name,
            $order->search->from_city,
            $order->search->from_pin,
            $order->search->toCountry->name,
            $order->search->to_city,
            $order->search->to_pin,
            ucfirst($order->search->shipment_type),
            packageTypes($order->search->package_type),
            $order->search->number_of_pieces,
            $order->billable_weight,
            $order->rate,
            $order->status_text(),
            $order->integrator->name,
            $order->hawbNumber,
            $order->created_at,
        ];
    }

    public function headings(): array
    {
        return [
            'Booking ID',
            'User',
            'User Email',
            'From Country',
            'From City',
            'From Pincode',
            'To Country',
            'To City',
            'To Pincode',
            'Shippment Type',
            'Package Type',
            'Number Of Pieces',
            'Weight',
            'Rate',
            'Status',
            'Integrator',
            'HAWB Number',
            'Date',
        ];
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Order::latest();

        if ($this->user_id !== '0') {
            $query->where('user_id', $this->user_id);
        }

        if ($this->start_date && $this->end_date) {
            $st_date = Carbon::parse($this->start_date)->startOfDay();
            $en_date = Carbon::parse($this->end_date)->endOfDay();
            $query->whereBetween('created_at', [$st_date, $en_date]);
        }

        if ($this->from_country_id !== '0') {
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->from_country ==  $this->from_country_id;
            // });
            $from_country_id = $this->from_country_id;
            $query->whereHas('search', function ($query) use ($from_country_id) {
                $query->where('from_country', $from_country_id);
            });
        }

        if ($this->to_country_id !== '0') {
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->to_country ==  $this->to_country_id;
            // });
            $to_country_id = $this->to_country_id;
            $query->whereHas('search', function ($query) use ($to_country_id) {
                $query->where('to_country', $to_country_id);
            });
        }

        if ($this->shipping_type !== '0') {
            $shipping_type = $this->shipping_type;
            $query->whereHas('search', function ($query) use ($shipping_type) {
                $query->where('shipment_type', $shipping_type);
            });
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->shipment_type ==  $this->shipping_type;
            // });
            // $query->where('shipment_type', $this->shipping_type);
        }

        if ($this->package_type !== '0') {
            $package_type = $this->package_type;
            $query->whereHas('search', function ($query) use ($package_type) {
                $query->where('package_type', $package_type);
            });
            // $collection = $collection->filter(function ($item) {
            //     return $item->search->package_type ==  $this->package_type;
            // });
            // $query->where('package_type', $this->package_type);
        }

        return $query->with(['user', 'search', 'integrator', 'search.fromCountry', 'search.toCountry'])->paginate(15);
    }
}
