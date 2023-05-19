<?php

namespace App\Imports\Admin;

use App\Models\Customer\CustomerRates as CustomerCustomerRates;
use App\Models\Zones\Zone;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustomerRates implements ToCollection
{

    public $errors;

    private $integrator;
    private $user;
    private $type;
    private $headings;

    public function __construct($user, $integrator, $type, $headings)
    {
        $this->errors = [];

        $this->integrator = $integrator;
        $this->user = $user;
        $this->type = $type;
        $this->headings = $headings[0];
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        $this->headings = array_slice($this->headings, 2);

        // $heading_ids = Zone::where('type', $this->type)->where('integrator_id', $this->integrator)->select(['id', 'zone_code'])->get();

        $this->headings = array_map('strtoupper', $this->headings);
        $this->headings = array_map('trim', $this->headings);

        CustomerCustomerRates::where([
            'user_id' => $this->user->id,
            'integrator_id' =>  $this->integrator,
            'type' =>  $this->type,
        ])->delete();

        foreach ($rows as $row) {

            $weight = $row[0];
            $weight_break = explode('-', $weight);

            foreach ($this->headings as $index => $heading) {
                $this->user->customerRate()->create([
                    'user_id' => $this->user->id,
                    'integrator_id' =>  $this->integrator,
                    'zone' =>  $heading,
                    'type' =>  $this->type,
                    'weight' =>  $weight_break[0],
                    'end_weight' =>  $weight_break[1] ?? $weight_break[0],
                    'pac_type' =>  $row[1],
                    'rate' =>  $row[$index + 2] ? (float)$this->cleanRate($row[$index + 2]) : 0,
                ]);
            }
        }
    }

    public function cleanRate($rate)
    {
        return str_replace(',', '', $rate);
    }
}
