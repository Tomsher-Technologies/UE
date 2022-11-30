<?php

namespace App\Imports;

use App\Models\Zones\OdPincodes;
use App\Models\Zones\Country;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class ODPicodeImport implements ToCollection
{

    private $integrator;

    public $errors;

    public function __construct($integrator)
    {
        $this->integrator = $integrator;
        $this->errors = [];
    }

    public function collection(Collection $rows)
    {
        $rows->shift();

        $countries = Country::latest()->get();

        foreach ($rows as $row) {
            $country = $countries
                ->where('name', $row[0])
                ->where('code', $row[1])
                ->first();

            $c_name = $row[0];
            $c_code = $row[1];

            $country = $countries->filter(function ($item) use ($c_name, $c_code) {
                return  stristr($item->name, $c_name) || stristr($item->code, $c_code);
            })->first();

            if ($country) {
                if ($row[2]) {
                    OdPincodes::updateOrCreate([
                        'integrator_id' => $this->integrator,
                        'pincode' => $row[2],
                        'rate' => $row[3],
                        'country_id' => $country->id,
                    ]);
                }
            } else {
                if (!in_array($row[0], $this->errors)) {
                    $this->errors[] = $row[0] . '( ' . $row[1] . ' )';
                }
            }
        }
    }
}
