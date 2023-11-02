<?php

namespace App\Imports\Admin;

use App\Models\Customer\CustomerRates as CustomerCustomerRates;
use App\Models\Zones\Zone;
use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustomerRates implements ToCollection
{

    public $errors;
    public $error_missing;

    private $integrator;
    private $user;
    private $type;
    private $headings;
    private $zones;

    public function __construct($user, $integrator, $type, $headings)
    {
        $this->errors = [];
        $this->error_missing = [];

        $this->integrator = $integrator;
        $this->user = $user;
        $this->type = $type;
        $this->headings = $headings[0];

        $this->zones = Zone::where([
            'type' => $this->type,
            'integrator_id' => $this->integrator
        ])->get()->pluck('zone_code')->toArray();
    }

    /**
     * @param Collection $collection
     */
    public function collection(Collection $rows)
    {
        $rows->shift();

        $this->headings = array_slice($this->headings, 2);

        $this->headings = array_map('strtoupper', $this->headings);
        $this->headings = array_map('trim', $this->headings);

        CustomerCustomerRates::where([
            'user_id' => $this->user->id,
            'integrator_id' =>  $this->integrator,
            'type' =>  $this->type,
        ])->delete();

        $row_count = 2;

        foreach ($rows as $row) {
            $weight = $row[0];
            $pack_type = $row[1];

            if ($weight == null || $weight == '' || $weight == " ") {
                $this->error_missing[$row_count][] = 'Weight is missing';
            }
            if ($pack_type == null || $pack_type == '' || $pack_type == " ") {
                $this->error_missing[$row_count][] = 'Package type is missing';
            }

            if (!isset($this->error_missing[$row_count])) {
                $weight_break = explode('-', $weight);
                foreach ($this->headings as $index => $heading) {
                    if ($heading) {
                        if (in_array($heading, $this->zones)) {
                            if ($row[$index + 2]) {
                                $this->user->customerRate()->create([
                                    'user_id' => $this->user->id,
                                    'integrator_id' =>  $this->integrator,
                                    'zone' =>  $heading,
                                    'type' =>  $this->type,
                                    'weight' =>  $weight_break[0],
                                    'end_weight' =>  $weight_break[1] ?? $weight_break[0],
                                    'pac_type' =>  $pack_type,
                                    'rate' =>  $row[$index + 2] ? (float)$this->cleanRate($row[$index + 2]) : 0,
                                ]);
                            } else {
                                $this->error_missing[$row_count][] = "Missing rate in zone $heading";
                            }
                        }
                    }
                }
            }

            $row_count++;
        }
    }

    public function cleanRate($rate)
    {
        return str_replace(',', '', $rate);
    }
}
