<?php

namespace App\Exports;

use App\Models\Orders\Search;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class HistoryExport implements FromCollection, WithHeadings, WithMapping
{

    private $user_id;
    private $from_country_id;
    private $to_country_id;
    private $shipping_type;
    private $package_type;
    private $start_date;
    private $end_date;

    public function __construct($user_id, $from_country_id, $to_country_id, $shipping_type, $package_type, $start_date, $end_date)
    {
        $this->user_id = $user_id;
        $this->from_country_id = $from_country_id;
        $this->to_country_id = $to_country_id;
        $this->shipping_type = $shipping_type;
        $this->package_type = $package_type;
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }


    public function headings(): array
    {
        return [
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
            'Date',
        ];
    }

    public function map($search): array
    {
        return [
            $search->user->name,
            $search->user->email,
            $search->fromCountry->name,
            $search->from_city,
            $search->from_pin,
            $search->toCountry->name,
            $search->to_city,
            $search->to_pin,
            ucfirst($search->shipment_type),
            packageTypes($search->package_type),
            $search->number_of_pieces,
            $search->created_at,
        ];
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {

        $query = Search::latest();

        if ($this->user_id !== '0') {
            $query->where('user_id', $this->user_id);
        }
        if ($this->from_country_id !== '0') {
            $query->where('from_country', $this->from_country_id);
        }
        if ($this->to_country_id !== '0') {
            $query->where('to_country', $this->to_country_id);
        }
        if ($this->shipping_type !== '0') {
            $query->where('shipment_type', $this->shipping_type);
        }
        if ($this->package_type !== '0') {
            $query->where('package_type', $this->package_type);
        }

        if ($this->start_date && $this->end_date) {
            $st_date = Carbon::parse($this->start_date)->startOfDay();
            $en_date = Carbon::parse($this->end_date)->endOfDay();
            $query->whereBetween('created_at', [$st_date, $en_date]);
        }

        return $query->with(['user', 'fromCountry', 'toCountry'])->get();
    }
}
